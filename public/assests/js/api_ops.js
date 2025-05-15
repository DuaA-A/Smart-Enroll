


document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#registrationForm");
    if (!form) return; 
    document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", function () {
            const passwordInput = this.parentElement.querySelector("input");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                passwordInput.type = "password";
                this.classList.replace("fa-eye", "fa-eye-slash");
            }
        });
    });

   
    async function checkFieldExists(field, value, errorElementId) {
        try {
            const response = await fetch("index.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-Requested-With": "XMLHttpRequest"
                },
                body: `action=check_${field}&${field}=${encodeURIComponent(value)}`
            });

            if (!response.ok) throw new Error("Network response was not ok");

            const data = await response.text();
            if (data.trim() === "taken") {
                showError(errorElementId, `${field.charAt(0).toUpperCase() + field.slice(1)} already exists.`);
                return true;
            }
        } catch (error) {
            console.error(`Error checking ${field}:`, error);
            showError(errorElementId, `Error checking ${field} availability.`);
            return true;
        }
        return false;
    }
   
   
    form.addEventListener("submit", async function (event) {
        event.preventDefault();
       
       
        document.querySelectorAll(".error-message").forEach((el) => {
            el.textContent = "";
            el.style.display = "none";
        });

        const username = form.username.value.trim();
        const email = form.email.value.trim();
        const password = form.password.value;
        const confirmPassword = form.confirm_password.value;
        let hasErrors = false;

       
        if (username.length < 3) {
            showError("username-error", "Username must be at least 3 characters.");
            hasErrors = true;
        } else {
            hasErrors = await checkFieldExists('username', username, 'username-error') || hasErrors;
        }

        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError("email-error", "Please enter a valid email address.");
            hasErrors = true;
        } else {
            hasErrors = await checkFieldExists('email', email, 'email-error') || hasErrors;
        }

       
        if (password.length < 8) {
            showError("password-error", "Password must be at least 8 characters.");
            hasErrors = true;
        } else if (!/\d/.test(password)) {
            showError("password-error", "Password must contain a number.");
            hasErrors = true;
        } else if (!/[\W_]/.test(password)) {
            showError("password-error", "Password must contain a special character.");
            hasErrors = true;
        }

       
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
