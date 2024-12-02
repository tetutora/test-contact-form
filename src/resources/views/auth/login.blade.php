@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__content-inner">
        <div class="login__content-title">
            <p>Login</p>
        </div>
        <div class="login-form">
            <form class="login-form__inner" action="/register" method="post">
                @csrf
                <div class="login-form__input">
                    <div class="login-fom__input-email">
                        <div class="input-label">メールアドレス</div>
                        <input type="email" name="email" class="input-email" placeholder="例:test@example.com" value="{{ old('email') }}">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="login-form__input">
                    <div class="login-fom__input-pass">
                        <div class="input-label">パスワード</div>
                        <input type="password" name="password" class="input-pass" placeholder="例:alskdjfhg">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="register-form__input">
                    <div class="register-fom__input-pass_confirmation">
                        <div class="input-label">パスワード確認</div>
                        <input type="password" name="password_confirmation" class="input-pass" placeholder="確認用パスワード">
                    </div>
                </div> -->
                <div class="register-form__button">
                    <button type="submit" class="register-form__button-submit">ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
