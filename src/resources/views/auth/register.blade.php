@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth_register.css') }}">
@endsection

@section('content')
<div class="auth-form--big">
    <div class="auth-form__heading">
        <h1 class="auth-form__heading-logo">PiGLy</h1>
        <p class="auth-form__heading-title">新規会員登録</p>
    </div>
    <p class="auth-form__step">STEP1 アカウント情報の登録</p>
    <div class="auth-form__content">
        <form class="form" action="/register/step1" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">お名前</div>
                <div class="form__group-text">
                    <input type="text" name="name" placeholder="名前を入力" />
                </div>
                <div class=form__group-alert>
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">メールアドレス</div>
                <div class="form__group-text">
                    <input type="email" name="email" placeholder="メールアドレスを入力" />
                </div>
                <div class=form__group-alert>
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">パスワード</div>
                <div class="form__group-text">
                    <input type="password" name="password" placeholder="パスワードを入力" />
                </div>
                <div class=form__group-alert>
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group-button">
                <button class="form__group-button--submit" type="submit">次に進む</button>
            </div>
            <div class="form__group-link">
                <a href="/login">ログインはこちら</a>
            </div>
        </form>
    </div>
</div>
@endsection