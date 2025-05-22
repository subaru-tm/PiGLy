# PiGLy

## 環境構築
- 環境については、commit後、リモートリポジトリにpushしたものをcloneして確認済です

- リモートリポジトリ
  - origin  git@github.com:subaru-tm/PiGLy.git

- Dockerビルド
  - docker-compose up -d --build
 
- モデル・マイグレーションファイルの作成コマンド・ファイル名
  - php artisan make:model WeightTarget -m
    - 作成したファイル名
      - WeightTarget.php
      - 2025_05_15_163354_create_weight_targets_table.php
          - ↑↑ 注）テーブル仕様に従いファイル名をリネーム済（テーブル名部分の"s"を取り除く）
  - php artisan make:model WeightLog -m
    - 作成したファイル名
    - WeightLog.php
    - 2025_05_15_163437_create_weight_logs_table.php

- シーダー・ファクトリファイルの作成・実行
  - php artisan make:seeder UsersTableSeeder
    - ユーザー情報（ログイン情報）については最下部「URL等」に記載
  - php artisan make:factory WeightTarget
  - php artisan make:factory WeightLog

  - 実行　php artisan db:seed
    - 正常終了、データの生成も問題ないことを確認済。

　- キーも生成済 php artisan key:generate

- その他（参考共有）
  - 作成したコントローラ
    - AuthController         :新規会員登録（step1）画面でのバリデーション、およびstep2への画面遷移、logoutのルーティング用。Fortify標準をコピペしてカスタム。
    - GoalCreateController   :新規会員登録（step2）画面でのバリデーション、および初回登録で、WeightTarget,WeightLogsの両テーブルへのinsert用として。 
    - WeightLogController    :管理画面を始め、体重登録画面、情報更新画面にて使用。
    - WeightTargetController :目標体重変更画面にて使用。
  - 作成したフォームリクエスト
    - 上記のコントローラに紐ついています。（このため説明は割愛致します）
      - AuthRequest
      - GoalCreateRequest
      - WeightLogRequest
      - WeightTargetRequest
  - 上述の中で、Fortifyの認証を一部分離しましたが、ログイン機能だけは一部不安があり、標準のFortifyをそのまま使っています。
    - つまりログインでのバリデーションは標準のままとなっており、要件を満たせていないです。
  - ページネーションのスタイル変更のため、下記を実行してカスタムの元としています。
    - php artisan vendor:publish --tag=laravel-pagination
      - resources/views/vendor/pagination配下にテンプレートが作成されたため、このうちの"default.blade.php"をコピーし、
      - weight-log-pagination.blade.php として修正して、同じ名称のcssファイルにてスタイルカスタムしました。

## 使用技術
- Laravel Framework 8.83.8
- mysql:8.0.26
- php:7.4.9-fpm
- nginx:1.21.1

## ER図
![image](https://github.com/user-attachments/assets/d62566d7-def0-4938-bcc6-a2178f6a714c)

## URL等
- 開発環境：http://localhost/
- phpMyAdmin: http://localhost:8080/
- シーダーで作成済のユーザーログイン情報
  - メールアドレス：test@test.com
  - パスワード    ：testpass
    - （参考までに）ユーザー名は「テストユーザー」です
