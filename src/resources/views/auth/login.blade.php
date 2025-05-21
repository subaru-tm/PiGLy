@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth_register.css') }}">
@endsection

@section('content')
<div class="auth-form--small">
    <div class="auth-form__heading">
        <h1 class="auth-form__heading-logo">PiGLy</h1>
        <p class="auth-form__heading-title">ログイン</p>
    </div>
    <div class="auth-form__content">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">メールアドレス</div>
                <div class="form__group-text">
                    <input type="email" name="email" placeholder="メールアドレスを入力" />
                </div>
                @error('email')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__group">
                <div class="form__group-title">パスワード</div>
                <div class="form__group-text">
                    <input type="password" name="password" placeholder="パスワードを入力" />
                </div>
                @error('password')
                    {{ $message }}
                @enderror
            </div>
            <div class="form__group-button">
                <button class="form__group-button--submit" type="submit">ログイン</button>
            </div>
            <div class="form__group-link">
                <a href="/register/step1">アカウント作成はこちらから</a>
            </div>
        </form>
    </div>
</div>
@endsection