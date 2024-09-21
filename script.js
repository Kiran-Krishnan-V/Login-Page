document.addEventListener('DOMContentLoaded', function() {
    // Select form elements from DOM
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');

    // Login form elements
    const loginUsernameInput = document.getElementById('login-username');
    const loginPasswordInput = document.getElementById('login-password');
    const loginErrorMessage = document.getElementById('login-error-message');

    // Signup form elements
    const signupUsernameInput = document.getElementById('signup-username');
    const signupEmailInput = document.getElementById('signup-email');
    const signupPasswordInput = document.getElementById('signup-password');
    const signupErrorMessage = document.getElementById('signup-error-message');

    // Validate login form
    function validateLoginForm() {
        let valid = true;
        loginErrorMessage.textContent = ""; // Clear previous error messages

        if (loginUsernameInput.value.trim() === '') {
            loginErrorMessage.textContent += "Username or Email is required.\n";
            valid = false;
        }

        if (loginPasswordInput.value.trim() === '') {
            loginErrorMessage.textContent += "    Password is required.\n";
            valid = false;
        } else if (loginPasswordInput.value.length < 8) {
            loginErrorMessage.textContent += "Password must be at least 8 characters long.\n";
            valid = false;
        }

        return valid;
    }

    // Validate signup form
    function validateSignupForm() {
        let valid = true;
        signupErrorMessage.textContent = ""; // Clear previous error messages

        if (signupUsernameInput.value.trim() === '') {
            signupErrorMessage.textContent += "Username is required.\n";
            valid = false;
        }

        if (signupEmailInput.value.trim() === '') {
            signupErrorMessage.textContent += "Email is required.\n";
            valid = false;
        } else if (!/\S+@\S+\.\S+/.test(signupEmailInput.value)) {
            signupErrorMessage.textContent += "Invalid email format.\n";
            valid = false;
        }

        if (signupPasswordInput.value.trim() === '') {
            signupErrorMessage.textContent += "Password is required.\n";
            valid = false;
        } else if (signupPasswordInput.value.length < 8) {
            signupErrorMessage.textContent += "Password must be at least 8 characters long.\n";
            valid = false;
        }

        return valid;
    }

    // Handle form submission
    loginForm.addEventListener('submit', function(event) {
        if (!validateLoginForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    signupForm.addEventListener('submit', function(event) {
        if (!validateSignupForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Toggle between forms
    document.getElementById('show-register').addEventListener('click', function(e) {
        e.preventDefault();
        loginForm.classList.remove('active');
        signupForm.classList.add('active');
    });

    document.getElementById('show-login').addEventListener('click', function(e) {
        e.preventDefault();
        signupForm.classList.remove('active');
        loginForm.classList.add('active');
    });
});
