@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endsection

@section('header')
<header class="header">
    <div class="header__inner">
        <a class="header__logo" href="/weight_logs" >
            PiGLy
        </a>
    </div>
    <nav class="header-nav">
        <a class="header-nav__setting-link" href="/weight_logs/goal_setting">
            <img src="{{ asset('img/setting_button.png') }}" alt="" width="18" height="18" />
            目標体重設定
        </a>
        <form class="header-nav__form" action="/logout" type="get">
            @csrf
            <button class="header-nav__from-button">
                <img src="{{ asset('img/logout_img.png') }}" alt="" width="18" height="18" />
                ログアウト
            </button>
        </form>
    </nav>
</header>
@endsection

@section('content')
<div class="content">
    <div class="content__inner">
        <div class="content__header">
            <h2>目標体重設定</h2>
        </div>
        <form class="setting-form" action="/weight_logs/goal_setting/update" method="post">
            @method('PATCH')
            @csrf
            <div class="setting-form__group">
                <input type="text" name="target_weight" value="{{ $weight_target['target_weight'] }}" /> kg
            </div>
            <div class="setting-form__alert-danger">
                @error('target_weight')
                    {{ $message }}
                @enderror
            </div>
            <div class="setting-form__button">
                <a href="/weight_logs" class="setting-form__button-reverse">戻る</a>
                <button class="setting-form__button-submit" type="submit">更新</button>
            </div>
        </form>
    </div>
</div>

@endsection