document.getElementById("profileForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    let formData = new FormData(this);

    // Send AJAX request to update profile
    fetch('../action/update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        swal.fire({
            title: "Profile Updated",
            text: message,
            icon: "success",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    })
    .catch(error => {
        swal.fire({
            title: "Error",
            text: "An error occurred while updating your profile.",
            icon: "error",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    });
});

document.getElementById("deleteBtn").addEventListener("click", function() {
    swal.fire({
        title: "Delete Account",
        text: "Are you sure you want to delete your account?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // Send AJAX request to delete account
            fetch('../action/delete_profile_action.php', {
                method: 'POST' // You can change the method to 'DELETE' if your server supports it
            })
            .then(response => response.text())
            .then(message => {
                swal.fire({
                    title: "Account Deleted",
                    text: message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didClose: () => {
                        // Redirect or perform any action after deletion
                        window.location.href = "index.html";
                    }
                });
            })
            .catch(error => {
                swal.fire({
                    title: "Error",
                    text: "An error occurred while deleting your account.",
                    icon: "error",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            });
        }
    });
});
