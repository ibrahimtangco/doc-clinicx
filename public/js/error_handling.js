const error = document.querySelectorAll('#error_msg');

// Check if the error array exists and it's not empty
if (error && error.length > 0) {
    // Loop through each error element
    error.forEach(errorElement => {
        // Hide the error message after 2000 milliseconds (2 seconds)
        setTimeout(() => {
            errorElement.style.display = 'none';
        }, 3000);
    });
}



