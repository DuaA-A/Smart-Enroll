
    // Form element
    const formm = document.querySelector('form');
    
    // Input fields
    const username = document.getElementById('username'); 
    const email = document.getElementById('email'); 
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const fullName = document.getElementById('full_name');
    const phone = document.getElementById('phone');
    const whatsapp = document.getElementById('whatsapp_number');
    const address = document.getElementById('address');
    const userImage = document.getElementById('user_image');

    
    // Error message elements
    const usernameError = document.getElementById('username-error');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm_password-error');
    const fullNameError = document.getElementById('full_name-error');
    const phoneError = document.getElementById('phone-error');
    const whatsappError = document.getElementById('whatsapp_number-error');
    const addressError = document.getElementById('address-error');
    const userImageError = document.getElementById('user_image-error');

    console.log(fullNameError,addressError,userImageError,phoneError);
    // Regex patterns
    const patterns = {
        username: /^[a-zA-Z0-9]{3,}$/,
        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        password: /^(?=.*[\W_]).{8,}$/,
        fullName: /^[a-zA-Z ]{3,}$/,
        phone: /^[0-9]{10,15}$/,
        whatsapp: /^\+[1-9]\d{7,14}$/,
        address: /^[a-zA-Z0-9\s,.'-]{5,}$/
    };
    
    // Validation functions
    function validateUsername() {
        if (!username.value.trim()) {
            usernameError.textContent = 'Username is required';
            return false;
        }
        if (!patterns.username.test(username.value)) {
            usernameError.textContent = 'Username must be at least 3 characters (letters and numbers only)';
            return false;
        }
        usernameError.textContent = '';
        return true;
    }
    
    function validateEmail() {
        if (!email.value.trim()) {
            emailError.textContent = 'Email is required';
            return false;
        }
        if (!patterns.email.test(email.value)) {
            emailError.textContent = 'Please enter a valid email address';
            return false;
        }
        emailError.textContent = '';
        return true;
    }
    
    function validatePassword() {
        if (!password.value.trim()) {
            passwordError.textContent = 'Password is required';
            return false;
        }
        if (!patterns.password.test(password.value)) {
            passwordError.textContent = 'Password must be at least 8 characters with at least 1 special char';
            return false;
        }
        
        passwordError.textContent = '';
        return true;
    }
    
    function validateConfirmPassword() {
        if (!confirmPassword.value.trim()) {
            confirmPasswordError.textContent = 'Please confirm your password';
            return false;
        }
        if (confirmPassword.value !== password.value) {
            confirmPasswordError.textContent = 'Passwords do not match';
            return false;
        }
        confirmPasswordError.textContent = '';
        return true;
    }
    
    function validateFullName() {
        if (!fullName.value.trim()) {
            fullNameError.textContent = 'Full name is required';
            return false;
        }
        if (!patterns.fullName.test(fullName.value)) {
            fullNameError.textContent = 'Full name must be at least 3 letters and contain only letters and spaces';
            return false;
        }
        fullNameError.textContent = '';
        return true;
    }
    
    function validatePhone() {
        if (!phone.value.trim()) {
            phoneError.textContent = 'Phone number is required';
            return false;
        }
        if (!patterns.phone.test(phone.value)) {
            phoneError.textContent = 'Please enter a valid phone number (10-15 digits)';
            return false;
        }
        phoneError.textContent = '';
        return true;
    }
    
    function validateWhatsapp() {
        if (!whatsapp.value.trim()) {
            whatsappError.textContent = 'WhatsApp number is required';
            return false;
        }
        if (!patterns.whatsapp.test(whatsapp.value)) {
            whatsappError.textContent = 'Please enter a valid WhatsAppnumber with country code';
            return false;
        }
        whatsappError.textContent = '';
        return true;
    }
    
    function validateAddress() {
        if (!address.value.trim()) {
            addressError.textContent = 'Address is required';
            return false;
        }
        if (!patterns.address.test(address.value)) {
            addressError.textContent = 'Please enter a valid address (at least 5 characters)';
            return false;
        }
        addressError.textContent = '';
        return true;
    }
    
    function validateUserImage() {
        if (!userImage.value) {
            userImageError.textContent = 'Profile picture is required';
            return false;
        }
        
        // Check file extension if a file is selected
        if (userImage.files.length > 0) {
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(userImage.value)) {
                userImageError.textContent = 'Please upload an image file (jpg, jpeg, png, gif)';
                return false;
            }
        }
        
        userImageError.textContent = '';
        return true;
    }
        
export function clearFormInputs() {
   
    username.value = '';
    email.value = '';
    password.value = '';
    confirmPassword.value = '';
    fullName.value = '';
    phone.value = '';
    whatsapp.value = '';
    address.value = '';
    userImage.value = ''; 

    usernameError.textContent = '';
    emailError.textContent = '';
    passwordError.textContent = '';
    confirmPasswordError.textContent = '';
    fullNameError.textContent = '';
    phoneError.textContent = '';
    whatsappError.textContent = '';
    addressError.textContent = '';
    userImageError.textContent = '';
}
    
    // Event listeners for real-time validation
    username.addEventListener('input', validateUsername);
    email.addEventListener('input', validateEmail);
    password.addEventListener('input', validatePassword);
    confirmPassword.addEventListener('input', validateConfirmPassword);
    fullName.addEventListener('input', validateFullName);
    phone.addEventListener('input', validatePhone);
    whatsapp.addEventListener('input', validateWhatsapp);
    address.addEventListener('input', validateAddress);
    userImage.addEventListener('change', validateUserImage);



export async function validateFormClientSide() {
    const isUsernameValid = validateUsername();
    const isEmailValid = validateEmail();
    const isPasswordValid = validatePassword();
    const isConfirmPasswordValid = validateConfirmPassword();
    const isFullNameValid = validateFullName();
    const isPhoneValid = validatePhone();
    const isWhatsappValid = validateWhatsapp();
    const isAddressValid = validateAddress();
    const isUserImageValid = validateUserImage();

    return isUsernameValid &&
           isEmailValid &&
           isPasswordValid &&
           isConfirmPasswordValid &&
           isFullNameValid &&
           isPhoneValid &&
           isWhatsappValid &&
           isAddressValid &&
           isUserImageValid;
}



