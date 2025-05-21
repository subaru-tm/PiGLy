@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth_register.css') }}">
@endsection

@section('content')
<div class="auth-form--small">
    <div class="auth-form__heading">
        <h1 class="auth-form__heading-logo">PiGLy</h1>
        <p class="auth-form__heading-title">新規会員登録</p>
    </div>
    <p class="auth-form__step">STEP2 体重データの入力</p>
    <div class="auth-form__content">
        <form class="form" action="/register/step2" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">現在の体重</div>
                <div class="form__group-text">
                    <input type="text" name="weight" placeholder="現在の体重を入力" /> kg
                </div>
                <div class=form__group-alert>
                    @error('weight')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">目標の体重</div>
                <div class="form__group-text">
                    <input type="text" name="target_weight" placeholder="目標の体重を入力" /> kg
                </div>
                <div class=form__group-alert>
                    @error('target_weight')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group-button">
                <button class="form__group-button--submit" type="submit">アカウント作成</button>
            </div>
        </form>
    </div>
</div>
@endsection