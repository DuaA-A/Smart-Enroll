@extends('layouts.app')
@section('content')
<div class="container">
<div class="title">{{ __('Welcome! Let's get you enrolled today.') }}</div>
<form id="registrationForm" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="user-details">
<div class="input-box">
<span class="details"><i class="fas fa-user"></i> {{ __('Username') }}</span>
<input required type="text" name="username" id="username" placeholder="{{ __('Enter username') }}"
value="{{ old('username') }}">
<div class="error-message" id="username-error">@error('username') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-envelope"></i> {{ __('Email') }}</span>
<input required type="email" name="email" id="email" placeholder="{{ __('Enter email') }}"
value="{{ old('email') }}">
<div class="error-message" id="email-error">@error('email') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-lock"></i> {{ __('Password') }}</span>
<div class="password-field">
<input required type="password" name="password" id="password"
placeholder="{{ __('Enter password') }}">
<i class="fa-solid fa-eye-slash toggle-password"></i>
</div>
<div class="error-message" id="password-error">@error('password') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-lock"></i> {{ __('Confirm password') }}</span>
<div class="password-field">
<input required type="password" name="password_confirmation" id="confirm_password"
placeholder="{{ __('confirm password') }}">
<i class="fa-solid fa-eye-slash toggle-password"></i>
</div>
<div class="error-message" id="confirm_password-error">@error('password_confirmation') {{ $message }}
@enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-user-circle"></i> {{ __('Full name') }}</span>
<input required type="text" name="full_name" id="full_name" placeholder="{{ __('enter full name') }}"
value="{{ old('full_name') }}">
<div class="error-message" id="full_name-error">@error('full_name') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-phone"></i> {{ __('Phone number') }}</span>
<input required type="tel" name="phone" id="phone" placeholder="{{ __('enter phone number') }}"
value="{{ old('phone') }}" pattern="[0-9]{10,}">
<div class="error-message" id="phone-error">@error('phone') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fab fa-whatsapp"></i> WhatsApp</span>
<input type="tel" name="whatsapp_number" id="whatsapp_number" placeholder="+201244383411"
value="{{ old('whatsapp_number') }}">
<span class="error-whatsapp error-message" id="whatsapp_number-error"></span>
<span class="valid-whatsapp" id="whatsapp_number-valid"></span>
</div>
<div class="input-box">
<button type="button" id="whatsapp">Check WhatsApp Number</button>
</div>


<div class="input-box">
<span class="details"><i class="fas fa-map-marker-alt"></i> {{ __('address') }}</span>
<input required type="text" name="address" id="address" placeholder="{{ __('enter address') }}"
value="{{ old('address') }}">
<div class="error-message" id="address-error">@error('address') {{ $message }} @enderror</div>
</div>

<div class="input-box">
<span class="details"><i class="fas fa-image"></i> {{ __('Profile picture') }}</span>
<input required type="file" name="user_image" id="user_image" accept="image/*">
<div class="error-message" id="user_image-error">@error('user_image') {{ $message }} @enderror</div>
</div>
</div>

@if ($errors->any())
<div class="server-errors">
@foreach ($errors->all() as $error)
<div class="error-message">{{ $error }}</div>
@endforeach
</div>
@endif

<div class="button">
<input type="submit" value="{{ __('Register') }}">
</div>
</form>
</div>
<script>
const formm = document.querySelector('form');
const username = document.getElementById('username'); 
const email = document.getElementById('email'); 
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm_password');
const fullName = document.getElementById('full_name');
const phone = document.getElementById('phone');
const whatsapp = document.getElementById('whatsapp_number');
const address = document.getElementById('address');
const userImage = document.getElementById('user_image');

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

const patterns = {
    username: /^[a-zA-Z0-9]{3,}$/,
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    password: /^(?=.*[\W_]).{8,}$/,
    fullName: /^[a-zA-Z ]{3,}$/,
    phone: /^[0-9]{10,15}$/,
    whatsapp: /^\+[0-9]{10,15}$/  
    address: /^[a-zA-Z0-9\s,.'-]{5,}$/
};

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
        whatsappError.textContent = 'Please enter a valid WhatsApp number with country code';
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

export async function checkFieldExists(field, value, errorElementId) {
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
</script>

@endsection