document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#registrationForm");
    if (!form) return;

    // Password toggle
    document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", function () {
            const passwordInput = this.previousElementSibling;
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passwordInput.type = "password";
                this.classList.replace("fa-eye", "fa-eye-slash");
            }
        });
    });

    // Check field availability via AJAX (Laravel route)
    async function checkFieldExists(field, value, errorElementId) {
        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            const response = await fetch(`/check-${field}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({ [field]: value })
            });

            if (!response.ok) throw new Error("Network response was not ok");

            const data = await response.json();
            if (data.exists) {
                showError(errorElementId, `${capitalize(field)} already exists.`);
                return true;
            }
        } catch (error) {
            console.error(`Error checking ${field}:`, error);
            showError(errorElementId, `Error checking ${field} availability.`);
            return true;
        }
        return false;
    }

    // Capitalize helper
    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    // Form submit
    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        document.querySelectorAll(".error-message").forEach((el) => {
            el.textContent = "";
            el.style.display = "none";
        });

        const username = form.username.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value;
        const confirmPassword = form.password_confirmation.value;

        let hasErrors = false;

        // Username validation
        if (username.length < 3) {
            showError("username-error", "Username must be at least 3 characters.");
            hasErrors = true;
        } else {
            hasErrors = await checkFieldExists('username', username, 'username-error') || hasErrors;
        }

        // Email validation
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError("email-error", "Please enter a valid email address.");
            hasErrors = true;
        } else {
            hasErrors = await checkFieldExists('email', email, 'email-error') || hasErrors;
        }

        // Password validation
        if (password.length < 8) {
            showError("password-error", "Password must be at least 8 characters.");
            hasErrors = true;
        } else if (!/\d/.test(password)) {
            showError("password-error", "Password must contain at least one number.");
            hasErrors = true;
        } else if (!/[\W_]/.test(password)) {
            showError("password-error", "Password must contain at least one special character.");
            hasErrors = true;
        }

        // Confirm password
        if (password !== confirmPassword) {
            showError("confirm_password-error", "Passwords do not match.");
            hasErrors = true;
        }

        if (!hasErrors) {
            form.submit();
        }
    });

    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = "block";
            errorElement.style.color = "red";
            errorElement.style.fontSize = "0.9em";
            errorElement.style.marginTop = "5px";
        } else {
            console.error(`Error element with ID ${fieldId} not found`);
        }
    }
});
