@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">
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
<div class="weight-logs__content">
    <div class="target-compare">
        <div class="target-compare__group">
            <p class="target-compare__headeing">
                目標体重
            </p>
            <span class="target-compare__weight">
                {{ $weight_target['target_weight'] }}
            </span>
            <span class="target-compare__unit">kg</span>
        </div>
        <div class="target-compare__separate"></div>
        <div class="target-compare__group">
            <p class="target-compare__headeing">
                目標まで
            </p>
            <span class="target-compare__weight">
                <?php
                    $diff =  -1 * ( $last_weight['weight'] - $weight_target['target_weight'] );
                ?>
                {{ $diff }}
            </span>
            <span class="target-compare__unit">kg</span>
            @if ($diff >= 0)
                <span class="achivement"> 目標達成</span>
            @endif
        </div>
        <div class="target-compare__separate"></div>
        <div class="target-compare__group">
            <p class="target-compare__headeing">
                最新体重
            </p>
            <span class="target-compare__weight">
                {{ $last_weight['weight'] }}
            </span>
            <span class="target-compare__unit">kg</span>
        </div>
    </div>
    <div class="logs-index">
        <div class="logs-index__heading">
            <span class="logs-index__heading-search">
                @if(!isset($from))
                    <?php $from = null; ?>
                @endif
                @if(!isset($until))
                    <?php $until = null; ?>
                @endif
                <form class="search-form" action="/weight_logs/search" method="get">
                    @csrf
                    <input type="date" name="from" placeholder="年/月/日" />
                    <span> ~ </span>
                    <input type="date" name="until" placeholder="年/月/日" />
                    <button class="search-form__button-submit" type="submit">検索</button>
                    @if(isset($from) or isset($until))
                        <form class="search-form__reset" action="/weight_logs" method="get">
                            @csrf
                            <button class="search-form__reset-button" type="submit">リセット</button>
                        </form>
                    @endif
                </form>
            </span>
            <a class="logs-index__heading-create" href="#create">
                <img src="{{ asset('img/add_data_button.png') }}" alt="" width="148" height="44" />
            </a>
        </div>
        @if(isset($from) or isset($until))
        <div class="search-form__submit-conditions">
            {{ $from }}～{{ $until }} の検索結果　{{ $logs_count }}件
        </div>
        @endif

        <div class="create-modal" id="create"
            @if ($errors->any())
                style="visibility: visible; opacity: 1;"
            @endif
        >
            <a href="#!" class="create-modal-overlay"></a>
            <div class="create-modal__inner">
                <div class="create-modal__header">Weight Logを追加</div>
                <div class="create-modal__content">
                    <form class="create-modal__form" action="/weight_logs/create" method="post">
                        @csrf
                        <div class="create-modal__form-group">
                            <label class="create-modal__form-label">日付</label>
                            <span class="create-modal__form-required">必須</span>
                            <div>
                                <input class="create-modal__form-input" type="date" name="date" placeholder="年/月/日" value="{{ old('name') }}" />
                            </div>
                            <div class="create-modal__form-error--message">
                                @error('date')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="create-modal__form-group">
                            <label class="create-modal__form-label">体重</label>
                            <span class="create-modal__form-required">必須</span>
                            <div>
                                <input class="create-modal__form-input" type="text" name="weight" placeholder="50.0" />
                                <span>kg</span>
                            </div>
                            <div class="create-modal__form-error--message">
                                @error('weight')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="create-modal__form-group">
                            <label class="create-modal__form-label">摂取カロリー</label>
                            <span class="create-modal__form-required">必須</span>
                            <div>
                                <input class="create-modal__form-input" type="text" name="calories" placeholder="1200" />
                                <span>cal</span>
                            </div>
                            <div class="create-modal__form-error--message">
                                @error('calories')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="create-modal__form-group">
                            <label class="create-modal__form-label">運動時間</label>
                            <span class="create-modal__form-required">必須</span>
                            <div>
                                <input class="create-modal__form-input" type="time" name="exercise_time" placeholder="00:00" />
                            </div>
                            <div class="create-modal__form-error--message">
                                @error('exercise_time')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="create-modal__form-group">
                            <label class="create-modal__form-label">運動内容</label>

                            <div>
                                <textarea class="create-modal__form-textarea" name="exercise_content" cols="88" rows="5" placeholder="運動内容を追加"></textarea>
                            </div>
                            <div class="create-modal__form-error--message">
                                @error('exercise_content')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="create-modal__form-button">
                            <a href="#" class="create-modal__reverse-button">戻る</a>
                            <button class="create-modal__submit-button" type="submit">登録</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="logs-table">
            <table class="logs-table__inner">
                <tr class="logs-table__row">
                    <th class="logs-table__header">
                        <td class="logs-table__header-item">日付</td>
                        <td class="logs-table__header-item">体重</td>
                        <td class="logs-table__header-item">食事摂取カロリー</td>
                        <td class="logs-table__header-item">運動時間</td>
                        <td class="logs-table__header-item"> </td>
                    </th>
                </tr>

                @foreach($weight_logs as $weight_log)
                <tr class="logs-table__row">
                    <th></th>
                    <td class="logs-table__item">{{ $weight_log['date'] }}</td>
                    <td class="logs-table__item">{{ $weight_log['weight'] }} kg</td>
                    <td class="logs-table__item">{{ $weight_log['calories'] }} cal</td>
                    <td class="logs-table__item">{{ date('H:i', strtotime($weight_log['exercise_time'])) }}</td>
                    <td class="logs-table__item">
                        <a class="logs-table__item-upbtn" href="/weight_logs/:{{ $weight_log['id'] }}">
                            <img src="{{ asset('img/log_update_button.png') }}" alt="" width="24" height="24" />
                        </a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="logs-footer">
            {{ $weight_logs->appends([
                'from' => $from,
                'until' => $until,
                ])->links() }}
        </div>
    </div>
</div>

@endsection
