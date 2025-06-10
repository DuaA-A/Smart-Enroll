@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="title">{{ __('auth.Welcome! Let\'s get you enrolled today.') }}</div>
           <form id="registrationForm" action="{{ url(app()->getLocale() . '/register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <span class="details"><i class="fas fa-user"></i> {{ __('auth.Username') }}</span>
                    <input  type="text" name="username" id="username" placeholder="{{ __('auth.Enter username') }}"
                        value="{{ old('username') }}">
                    <div class="error-message" id="username-error">@error('username') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-envelope"></i> {{ __('auth.Email') }}</span>
                    <input  type="email" name="email" id="email" placeholder="{{ __('auth.Enter email') }}"
                        value="{{ old('email') }}">
                    <div class="error-message" id="email-error">@error('email') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> {{ __('auth.Password') }}</span>
                    <div class="password-field">
                        <input  type="password" name="password" id="password"
                            placeholder="{{ __('auth.Enter password') }}">
                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                    <div class="error-message" id="password-error">@error('password') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-lock"></i> {{ __('auth.Confirm password') }}</span>
                    <div class="password-field">
                        <input  type="password" name="password_confirmation" id="confirm_password"
                            placeholder="{{ __('auth.confirm password') }}">
                        <i class="fa-solid fa-eye-slash toggle-password"></i>
                    </div>
                    <div class="error-message" id="confirm_password-error">@error('password_confirmation') {{ $message }}
                    @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-user-circle"></i> {{ __('auth.Full name') }}</span>
                    <input  type="text" name="full_name" id="full_name" placeholder="{{ __('auth.enter full name') }}"
                        value="{{ old('full_name') }}">
                    <div class="error-message" id="full_name-error">@error('full_name') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-phone"></i> {{ __('auth.Phone number') }}</span>
                    <input  type="tel" name="phone" id="phone" placeholder="{{ __('auth.enter phone number') }}"
                        value="{{ old('phone') }}" pattern="[0-9]{10,}">
                    <div class="error-message" id="phone-error">@error('phone') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fab fa-whatsapp"></i> {{ __('auth.messages.whatsapp') }}</span>
                    <input type="tel" name="whatsapp_number" id="whatsapp_number" placeholder="+201244383411"
                        value="<?= htmlspecialchars($_POST['whatsapp_number'] ?? '') ?>">
                    <span class="error-whatsapp error-message" id="whatsapp_number-error">@error('whatsapp_number') {{ $message }} @enderror</span>
                    <span class="valid-whatsapp" id="whatsapp_number-valid"></span>
                </div>
                <div class="input-box">
                    <button type="button" id="whatsapp">{{ __('auth.Check WhatsApp Number') }}</button>
                </div>


                <div class="input-box">
                    <span class="details"><i class="fas fa-map-marker-alt"></i> {{ __('auth.address') }}</span>
                    <input  type="text" name="address" id="address" placeholder="{{ __('auth.enter address') }}"
                        value="{{ old('address') }}">
                    <div class="error-message" id="address-error">@error('address') {{ $message }} @enderror</div>
                </div>

                <div class="input-box">
                    <span class="details"><i class="fas fa-image"></i> {{ __('auth.Profile picture') }}</span>
                    <input  type="file" name="user_image" id="user_image" accept="image/*">
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
@endsection