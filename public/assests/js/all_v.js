import { validateFormClientSide,clearFormInputs } from './client_v';
import { checkFieldExists } from './server_v.js';

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#registrationForm");
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

    form.addEventListener("submit", async function (event) {
        event.preventDefault();

        const isClientValid = await validateFormClientSide();

        const username = form.username.value.trim();
        const email = form.email.value.trim();

        let hasErrors = false;

        if (await checkFieldExists('username', username, 'username-error')) hasErrors = true;
        if (await checkFieldExists('email', email, 'email-error')) hasErrors = true;

        if (isClientValid && !hasErrors) {
            form.submit();
            alert('✅ Data submitted successfully!');
            clearFormInputs();
            
        }
    });
});
