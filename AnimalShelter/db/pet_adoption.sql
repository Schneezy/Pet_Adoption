-- Drop the database if it exists
DROP DATABASE IF EXISTS pet_adoption;

-- Create the database
CREATE DATABASE pet_adoption;

-- Use the newly created database
USE pet_adoption;

-- Create Role Table
CREATE TABLE Role (
    RoleID INT PRIMARY KEY AUTO_INCREMENT,
    RoleName VARCHAR(50) UNIQUE
);

-- Insert sample data into Role Table
INSERT INTO Role (RoleName) VALUES
('admin'),
('user'); -- Changed 'standard' to 'user'

-- Create Status Table
CREATE TABLE Status (
    StatusID INT PRIMARY KEY AUTO_INCREMENT,
    StatusName VARCHAR(50) UNIQUE
);

-- Insert sample data into Status Table
INSERT INTO Status (StatusName) VALUES
('Approved'),
('Pending'),
('Rejected');

-- Create Size Table
CREATE TABLE Size (
    SizeID INT PRIMARY KEY AUTO_INCREMENT,
    SizeName VARCHAR(50) UNIQUE
);

-- Insert sample data into Size Table
INSERT INTO Size (SizeName) VALUES
('Small'),
('Medium'),
('Large');

-- Create AnimalType Table
CREATE TABLE AnimalType (
    TypeID INT PRIMARY KEY AUTO_INCREMENT,
    TypeName VARCHAR(50) UNIQUE
);

-- Insert sample data into AnimalType Table
INSERT INTO AnimalType (TypeName) VALUES
('Dog'),
('Cat'),
('Other');

-- Create Gender Table
CREATE TABLE Gender (
    GenderID INT PRIMARY KEY AUTO_INCREMENT,
    GenderName VARCHAR(50) UNIQUE
);

-- Insert sample data into Gender Table
INSERT INTO Gender (GenderName) VALUES
('Male'),
('Female');

-- Create User Table
CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    RoleID INT,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    GenderID INT NOT NULL,
    DateOfBirth DATE NOT NULL,
    Phone VARCHAR(20) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    StatusID INT DEFAULT 1, -- Default status ID
    FOREIGN KEY (RoleID) REFERENCES Role(RoleID),
    FOREIGN KEY (GenderID) REFERENCES Gender(GenderID),
    FOREIGN KEY (StatusID) REFERENCES Status(StatusID)
);

-- Create Pet Table with SizeID, TypeID, and GenderID Foreign Keys
CREATE TABLE Pets (
    PetID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(255),
    TypeID INT, -- Foreign Key for AnimalType
    Species VARCHAR(50),
    Age INT,
    GenderID INT, -- Foreign Key for Gender
    SizeID INT, -- Foreign Key for Size
    Location VARCHAR(100),
    Description TEXT,
    HealthStatus VARCHAR(100),
    Vaccinations TEXT,
    Behavior TEXT,
    SpecialNeeds TEXT,
    ImageURL1 VARCHAR(255),
    FOREIGN KEY (TypeID) REFERENCES AnimalType(TypeID), -- Reference to AnimalType Table
    FOREIGN KEY (GenderID) REFERENCES Gender(GenderID), -- Reference to Gender Table
    FOREIGN KEY (SizeID) REFERENCES Size(SizeID) -- Reference to Size Table
);

-- Create AdoptionRequests Table with PetID, UserID, and StatusID Foreign Keys
CREATE TABLE AdoptionRequests (
    RequestID INT PRIMARY KEY AUTO_INCREMENT,
    PetID INT,
    UserID INT,
    LivingSituation TEXT,
    PetExperience TEXT,
    SuitabilityReasons TEXT,
    StatusID INT,
    FOREIGN KEY (PetID) REFERENCES Pets(PetID),
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    FOREIGN KEY (StatusID) REFERENCES Status(StatusID)
);

-- Create stored procedure to drop Unique_Email index if it exists
DELIMITER //
CREATE PROCEDURE DropUniqueEmailIndex()
BEGIN
    DECLARE index_exists INT;

    -- Check if the Unique_Email index exists
    SELECT COUNT(*)
    INTO index_exists
    FROM information_schema.statistics
    WHERE table_schema = 'pet_adoption'
    AND table_name = 'User'
    AND index_name = 'Unique_Email'
    AND non_unique = 0;

    -- Drop the Unique_Email index if it exists
    IF index_exists > 0 THEN
        SET @drop_index_sql = 'ALTER TABLE User DROP INDEX Unique_Email;';
        PREPARE drop_index_stmt FROM @drop_index_sql;
        EXECUTE drop_index_stmt;
        DEALLOCATE PREPARE drop_index_stmt;
    END IF;
END //
DELIMITER ;

-- Call the stored procedure to drop Unique_Email index if it exists
CALL DropUniqueEmailIndex();

-- Modify columns with NOT NULL constraints
ALTER TABLE User
MODIFY COLUMN FirstName VARCHAR(50) NOT NULL,
MODIFY COLUMN LastName VARCHAR(50) NOT NULL,
MODIFY COLUMN GenderID INT NOT NULL, -- Changed to reference GenderID from Gender table
MODIFY COLUMN DateOfBirth DATE NOT NULL,
MODIFY COLUMN Phone VARCHAR(20) NOT NULL,
MODIFY COLUMN Email VARCHAR(100) NOT NULL UNIQUE,
MODIFY COLUMN Password VARCHAR(255) NOT NULL;

-- Add Check_PhoneNumber constraint to validate phone format
ALTER TABLE User
ADD CONSTRAINT Check_PhoneNumber CHECK (Phone REGEXP '^[0-9]{10}$');
