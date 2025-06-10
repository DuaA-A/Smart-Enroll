@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="title">{{ __('auth.Welcome! Let\'s get you enrolled today.') }}</div>
           <form id="registrationForm" action="{{ url(app()->getLocale() . '/register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <span class="details"><i class="fas fa-user"></i> {{ __('auth.Username') }}</span>
                    <input required type="text" name="username" id="username" placeholder="{{ __('auth.Enter username') }}"
                        value="{{ old('username') }}">
                    <div class="error-message" id="username-error">@error('username') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-envelope"></i> {{ __('auth.Email') }}</span>
                    <input required type="email" name="email" id="email" placeholder="{{ __('auth.Enter email') }}"
                        value="{{ old('email') }}">
                    <div class="error-message" id="email-error">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> {{ __('auth.Password') }}</span>
                    <div class="password-field">
                        <input required type="password" name="password" id="password"
                            placeholder="{{ __('auth.Enter password') }}">
                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                    <div class="error-message" id="password-error">@error('password') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> {{ __('auth.Confirm password') }}</span>
                    <div class="password-field">
                        <input required type="password" name="password_confirmation" id="confirm_password"
                            placeholder="{{ __('auth.confirm password') }}">
                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                    <div class="error-message" id="confirm_password-error">@error('password_confirmation') {{ $message }}
                    @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-user-circle"></i> {{ __('auth.Full name') }}</span>
                    <input required type="text" name="full_name" id="full_name" placeholder="{{ __('auth.enter full name') }}"
                        value="{{ old('full_name') }}">
                    <div class="error-message" id="full_name-error">@error('full_name') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-phone"></i> {{ __('auth.Phone number') }}</span>
                    <input required type="tel" name="phone" id="phone" placeholder="{{ __('auth.enter phone number') }}"
                        value="{{ old('phone') }}" pattern="[0-9]{10,}">
                    <div class="error-message" id="phone-error">@error('phone') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fab fa-whatsapp"></i> {{ __('auth.messages.whatsapp') }}</span>
                    <input type="tel" name="whatsapp_number" id="whatsapp_number" placeholder="+201244383411"
                        value="<?= htmlspecialchars($_POST['whatsapp_number'] ?? '') ?>">
                    <span class="error-whatsapp error-message" id="whatsapp_number-error"></span>
                    <span class="valid-whatsapp" id="whatsapp_number-valid"></span>
                </div>
                <div class="input-box">
                    <button type="button" id="whatsapp">{{ __('auth.Check WhatsApp Number') }}</button>
                </div>


                <div class="input-box">
                    <span class="details"><i class="fas fa-map-marker-alt"></i> {{ __('auth.address') }}</span>
                    <input required type="text" name="address" id="address" placeholder="{{ __('auth.enter address') }}"
                        value="{{ old('address') }}">
                    <div class="error-message" id="address-error">@error('address') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-image"></i> {{ __('auth.Profile picture') }}</span>
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
                <input type="submit" value="{{ __('auth.Register') }}">
            </div>
        </form>
    </div>

    <script>
        document.getElementById('registrationForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            formData.append('ajax', 'true');

            const response = await fetch('{{ url(app()->getLocale() . "/register") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
    });

            const result = await response.json();

            if (result.success) {
                window.location.href = result.redirect;
            } else {
                const errorContainer = document.createElement('div');
                errorContainer.classList.add('server-errors');
                errorContainer.innerHTML = result.errors.map(err => `<div class="error-message">${err}</div>`).join('');
                form.querySelector('.server-errors')?.remove();
                form.insertBefore(errorContainer, form.querySelector('.button'));
            }
        });

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
                    const route = field === 'username' ? '{{ url(app()->getLocale() . "/check-username") }}' : 
                                field === 'email' ? '{{ url(app()->getLocale() . "/check-email") }}' : '';
                    const response = await fetch(route, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": '{{ csrf_token() }}'
                        },
                        body: `${field}=${encodeURIComponent(value)}`
                    });

                    if (!response.ok) throw new Error("Network response was not ok");

                    const data = await response.text();
                } catch (error) {
                    console.error(`Error checking ${field}:`, error);
                    showError(errorElementId, `{{ __("auth.error while checking") }} ${field} {{ __("auth.availability") }}`);
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
                const confirmPassword = form.password_confirmation.value;
                const whatsappNumber = form.whatsapp_number.value.trim();
                let hasErrors = false;

                if (username.length < 3) {
                    showError("username-error", "{{ __('auth.username must be atleast 3 characters') }}");
                    hasErrors = true;
                } else {
                    hasErrors = await checkFieldExists('username', username, 'username-error') || hasErrors;
                }

                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showError("Error", "{{ __('auth.Enter a valid email format') }}");
                    hasErrors = true;
                } else {
                    hasErrors = await checkFieldExists('email', email, 'email-error') || hasErrors;
                }

                if (password.length < 8) {
                    showError("password-error", "{{ __('auth.password must be more at least 8, with special charcter and letter charcter') }}");
                    hasErrors = true;
                } else if (!/\d/.test(password)) {
                    showError("password-error", "{{ __('auth.password must have numbers') }}");
                    hasErrors = true;
                } else if (!/[\W_]/.test(password)) {
                    showError("password-error", "{{ __('auth.password must have special character') }}");
                    hasErrors = true;
                }

                if (password !== confirmPassword) {
                    showError("confirm_password-error", "{{ __('auth.passwords doesn\'t match') }}");
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
    </script>
@endsection