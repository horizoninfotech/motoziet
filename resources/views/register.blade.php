@extends('layouts.main')

@section('title', __('auth.register_your_account'))

@section('content')
<!-- BREADCRUMB AREA START -->
@php
    $dir = in_array(app()->getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr';
@endphp
<div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bs-bg="img/bg/9.jpg" dir="{{ $dir }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                    <div class="section-title-area ltn__section-title-2">
                        <h6 class="section-subtitle ltn__secondary-color">//  {{ __('auth.welcome_message') }}</h6>
                        <h1 class="section-title white-color">{{ __('auth.account') }}</h1>
                    </div>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html">{{ __('auth.home') }}</a></li>
                            <li>{{ __('auth.register') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- LOGIN AREA START (Register) -->
@php
    $dir = in_array(app()->getLocale(), ['ar', 'ur']) ? 'rtl' : 'ltr';
@endphp
<div class="ltn__login-area pb-110"  dir="{{ $dir }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">{{ __('auth.register') }} <br>{{ __('auth.register_your_account') }}</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="{{ route('register') }}" method="POST" class="ltn__form-box contact-form-box">
                        @csrf  <!-- This will generate the CSRF token input field -->
                    
                        <input type="text" name="firstname" placeholder="{{ __('auth.first_name') }}" value="{{ old('firstname') }}">
                        @error('firstname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    
                        <input type="text" name="lastname" placeholder="{{ __('auth.last_name') }}" value="{{ old('lastname') }}">
                        @error('lastname')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    
                        <input type="text" name="email" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    
                        <input type="password" name="password" placeholder="{{ __('auth.password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    
                        <input type="password" name="password_confirmation" placeholder="{{ __('auth.confirm_password') }}">
                        @error('password_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    
                        <label class="checkbox-inline">
                            <input type="checkbox" value="">
                            {{ __('auth.privacy_consent') }}
                        </label>
                    
                        <div class="btn-wrapper">
                            <button class="theme-btn-1 btn reverse-color btn-block" type="submit">{{ __('auth.create_account') }}</button>
                        </div>
                    
                        <!-- Google Login Button -->
                        <div class="btn-wrapper mt-3">
                            <a href="{{ route('google.login') }}" class="btn btn-danger btn-block">
                                <i class="fab fa-google"></i> {{ __('auth.google_signup') }}
                            </a>
                        </div>
                    </form>
                    
                    <div class="by-agree text-center">
                        <p>{{ __('auth.agree_terms') }}</p>
                        <p><a href="#">{{ __('auth.terms_conditions') }}  &nbsp; &nbsp; | &nbsp; &nbsp;  {{ __('auth.privacy_policy') }}</a></p>
                        <div class="go-to-btn mt-50">
                            <a href="login.html">{{ __('auth.already_have_account') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->
@endsection
