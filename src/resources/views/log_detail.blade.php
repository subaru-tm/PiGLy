@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/log_detail.css') }}">
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
        <form class="header-nav__form" action="/logout" type="post">
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
        <div class="content__header">Weight Log</div>
        <div class="content__update">
            <form class="update-form" action="/weight_logs/:{{ $weight_log['id'] }}/update" method="post">
                @method('PATCH')
                @csrf
                <div class="update-form__group">
                    <label class="update-form__group-label">日付</label>
                    <div>
                        <input class="update-form__group-input" type="date" name="date" value="{{ $weight_log['date'] }}" />
                    </div>
                    <div class="update-form__alert-danger">
                        @error('date')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="update-form__group">
                    <label class="update-form__group-label">体重</label>
                    <div>
                        <input class="update-form__group-input" type="text" name="weight" value="{{ $weight_log['weight'] }}" />
                        <span>kg</span>
                    </div>
                    <div class="update-form__alert-danger">
                        @error('weight')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="update-form__group">
                    <label class="update-form__group-label">摂取カロリー</label>
                    <div>
                        <input class="update-form__group-input" type="text" name="calories" value="{{ $weight_log['calories'] }}" />
                        <span>cal</span>
                    </div>
                    <div class="update-form__alert-danger">
                        @error('calories')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="update-form__group">
                    <label class="update-form__group-label">運動時間</label>
                    <div>
                        <input class="update-form__group-input" type="time" name="exercise_time" value="{{ $weight_log['exercise_time'] }}" />
                    </div>
                    <div class="update-form__alert-danger">
                        @error('exercise_time')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="update-form__group">
                    <label class="update-form__group-label">運動内容</label>

                    <div>
                        <textarea class="update-form__group-textarea" name="exercise_content" cols="88" rows="5" value="{{ $weight_log['exercise_content'] }}" placeholder="運動内容を追加"></textarea>
                    </div>
                    <div class="update-form__alert-danger">
                        @error('exercise_content')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="update-form__button">
                    <a href="/weight_logs" class="update-form__button-reverse">戻る</a>
                    <button class="update-form__button-submit" type="submit">更新</button>
                </div>
            </form>
        </div>
        <div class="content__delete">
            <form class="delete-form" action="\weight_logs/:{{ $weight_log['id'] }}/delete" method="post">
                @method('DELETE')
                @csrf
                <button type="submit">
                    <img src="{{ asset('img/trash_can_img.png') }}" alt="" width="24" height="24" />
                </button>
            </form>
        </div>
    </div>
</div>
@endsection