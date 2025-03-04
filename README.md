# Rese
飲食店予約システム
<br>
ログイン後、店舗の予約やお気に入り登録、来店履歴の閲覧、レビューの投稿ができます。
<br>
管理者権限と店舗代表者権限を作成し、それぞれ機能を切り分けました。詳細については機能一覧にて記載しています。
<br>

### TOPページ
<img width="1379" alt="readme top" src="https://github.com/user-attachments/assets/4c933019-a2e1-4671-b0b5-1e0ca45b7a66" />

## 作成した目的
学習のアウトプットのため
<br>
企業の飲食店予約システムを作成
<br>
<br>

## 機能一覧
### 一般ユーザー
|会員登録画面|ログイン画面|
| --- | --- |
|<img width="1505" alt="c-register" src="https://github.com/user-attachments/assets/a8299d9b-ea0d-491d-8b79-4daa73a9a820" />|<img width="1505" alt="c-login" src="https://github.com/user-attachments/assets/f9fb6e93-703e-4721-8592-da803dc37979" />|
|名前、メールアドレス、パスワードを入力すると登録できます。|メールアドレス、パスワードを入力するとログインできます。|

|トップ画面|店舗詳細画面|
| --- | --- |
|<img width="1505" alt="readme top" src="https://github.com/user-attachments/assets/4c933019-a2e1-4671-b0b5-1e0ca45b7a66" />|<img width="1505" alt="スクリーンショット 2024-12-18 10 54 00" src="https://github.com/user-attachments/assets/e0762fba-f12b-476a-96c3-6ccdb3634136" />|
|エリア、ジャンル、ワードで店舗を検索できます。<br>ハートマークをクリックすることでお気に入り登録と解除の切り替えができます（未ログイン状態では登録できません）。<br>詳しくみるボタンをクリックすると店舗詳細画面に移ります。|店舗詳細情報やメニュー情報、レビュー内容を閲覧できます。<br>日付、時間、人数などを入力して予約できます（未ログイン状態では予約ができません）。支払い方法にクレジットカード決済を選択すると、stripe決済画面に移ります。|

|マイページ画面|来店履歴画面|
| --- | --- |
|<img width="1450" alt="mypage反映" src="https://github.com/user-attachments/assets/316294de-8145-4967-b9f9-0958ac69a4d2" />|<img width="1505" alt="来店履歴" src="https://github.com/user-attachments/assets/580b7178-73ad-4140-b7d9-6aa79a75aecb" />|
|本日分以降の予約情報が表示されます。editボタンをクリックで予約の変更、×ボタンをクリックで予約のキャンセルができます。<br>お気に入り登録している店舗が表示されます。ハートマークをクリックするとお気に入り登録を解除できます。|過去の来店履歴を閲覧できます。右のレビュー投稿ボタンをクリックし、評価とコメントを入力するとレビューを投稿できます。投稿したレビューは店舗詳細ページに反映されます。|

### 管理者
|管理者登録画面|
| --- |
|<img width="1505" alt="c-adminRegister" src="https://github.com/user-attachments/assets/c5e623c5-b734-4d91-93d3-00db13fe2d68" />|
|管理者登録専用画面です。名前、メールアドレス、パスワードを入力すると管理者権限が付与され登録できます。<br>以下、シーディングデータにてログイン後の画面<br>email : kanri_taro@test.com<br>password: test1234|

|管理者トップ画面|店舗代表者登録画面|
| --- | --- |
|<img width="1506" alt="c-admin-menu" src="https://github.com/user-attachments/assets/3a0035f1-e8f6-4895-8617-b2216766c20a" />|<img width="1505" alt="c-editorRegister" src="https://github.com/user-attachments/assets/81f87a23-a777-4163-a1ce-6e53eb2b0275" />|
|管理者ログイン後のトップページです。各メニューが表示されます。|店舗代表者登録専用画面です。名前、メールアドレス、仮パスワード、店舗を入力すると店舗代表者権限が付与され登録できます。1つの店舗に複数人の店舗代表者を登録できます。|

|ユーザーリスト画面|メール送信画面|
| --- | --- |
|<img width="1505" alt="リスト状況" src="https://github.com/user-attachments/assets/b98f7b86-6712-432c-8ae3-39355863c0b5" />|<img width="1505" alt="c-mail" src="https://github.com/user-attachments/assets/837f95fc-2e60-4dba-a352-294366ab092a" />|
|権限、店舗、ワードでユーザー検索できます。権限が付与されているユーザーには削除ボタンが表示され、クリックすると権限の削除ができます。(一般ユーザーに変更されます)|全ユーザー、一般ユーザー、店舗代表者、管理者の中から宛先を選択し、本文を入力して送信ボタンをクリックするとメール送信できます。|

### 店舗代表者
|店舗代表者登録完了メール（サンプル）|本パスワード登録画面|
| --- | --- |
|<img width="1720" alt="店舗代表者登録後メール" src="https://github.com/user-attachments/assets/2d3cd867-59ee-42d3-bbd2-bdf65b87b0aa" />|<img width="1305" alt="本パス登録画面" src="https://github.com/user-attachments/assets/f440ff94-b7c4-4cb5-98fe-fe11196e2d25" />|
|管理者側で店舗代表者を登録すると、登録完了メールが店舗代表者に送信されます。メールに記載のリンクからログインすると本パスワード登録画面に移ります。|登録完了メールに記載のリンクからログインすると本パスワード登録画面に移りますのでメールアドレス、現在のパスワード、新しいパスワードを入力すると本パスワードに更新されます。<br>以下、シーディングデータにてログイン後の画面<br>email : tenpo_hanako@test.com <br> password : test1234|

|店舗代表者トップ画面|店舗情報作成・編集画面|
| --- | --- |
|<img width="1504" alt="f-editorMenu" src="https://github.com/user-attachments/assets/41cebc1c-7a07-4fc7-bb92-9604b34e3b6d" />|<img width="1505" alt="店舗新規" src="https://github.com/user-attachments/assets/6336b19c-1a4e-4c9b-8dcf-266e9700bc7f" />|
|店舗代表者ログイン後のトップページです。各メニューが表示されます。|店舗情報の作成、編集ができます。既に店舗情報を登録している場合は登録されている情報が表示されます。|


|メニュー作成・編集画面|予約リスト画面|
| --- | --- |
|<img width="1305" alt="menu未登録" src="https://github.com/user-attachments/assets/87f57b40-f799-417e-833a-7d87decf69c1" />|<img width="1507" alt="来店" src="https://github.com/user-attachments/assets/4f711abe-e146-4125-8849-2258753a59bb" />|
|上の欄で店舗メニューを作成できます。下の欄に登録しているメニューが表示され、それぞれ編集、削除ができます。店舗情報を作成し、メニューはまだ登録していない場合はユーザー側で予約できない仕組みになっています。|日別の予約リストを閲覧できます。来店時に予約者に送られるリマインダーメールのQRコードを読み込むと予約リストのstatusが「来店」として反映されます。|

|リマインダーメール（サンプル）|QRコード読み取り後の画面|
| --- | --- |
|<img width="1200" alt="リマインダーメール" src="https://github.com/user-attachments/assets/eed1e72a-6faa-4a64-8dff-93b0aff47b8e" />|<img width="1347" alt="メール読み取り" src="https://github.com/user-attachments/assets/54b50ffd-5fed-4e1b-acc2-bbd2e5dcb5ae" />|
|予約当日朝に予約者に送信されるリマインダーメールです。予約内容と来店時に店舗側に提示するQRコードが添付されています。|店舗側がリマインダーメールのQRコードを読み込んだ後の画面です。予約内容が表示され、予約リストのstatusが「来店」として反映されます。|

### 共通機能
|ログアウト機能|メール認証機能|
| --- | --- |
|ログアウトボタンでサイトからログアウトできます。|会員登録時に本人確認のためのメールが送信されます。メールの中の認証ボタンをクリックするとログインできます。|

## 実行環境
Docker 26.1.1
<br>
nginx 1.21.1
<br>
php 8.3.8
<br>
mysql 8.0.26
<br>
phpMyAdmin 5.2.1
<br>
Mailhog

## 使用技術
Laravel Framework 8.83.8
<br>
Laravel Livewire
<br>
Laravel Fortify
<br>
Laravel Permission
<br>
Stripe
<br>
HTML/CSS
<br>
Javascript
<br>
PHP
<br>

## テーブル設計
<br>
<img width="702" alt="Reseテーブル設計" src="https://github.com/user-attachments/assets/6edc7642-9e6d-4cb8-8f6c-df4c2c35a33e" />
<br>

## ER図
![ER図](src/Rese.drawio.png)

## 環境構築

#### Docker ビルド

```
git clone githubのリンク
```

```
docker-compose up -d --build
```

> _Mac の M1・M2 チップの PC で設定しています。エラーが発生する場合は、platform: linux/x86_64をコメントアウトしてください。_
> docker-compose.yml ファイルの「mysql」、「phpMyAdmin」, 「mail」の3箇所に記載があります。_

```bash
mysql:
    platform: linux/x86_64(この文をコメントアウト)
    image: mysql:8.0.26
    environment:
```

<br>
<br>

#### Laravel環境構築
  1. PHPコンテナへ入る
  ```
  docker-compose exec php bash
  ```
  <br>

  2. composer をインストール
  
  ```
  composer install
  ```

  <br>
  
  3. .env.example ファイルをコピーして.env ファイルを作成し、環境変数を変更する
  
  ```
  cp .env.example .env
  ```

  <br>
  mysqlの設定(docker-compose.ymlを参照)
  
  ```
  DB_CONNECTION=mysql
  DB_HOST=mysql(変更)
  DB_PORT=3306
  DB_DATABASE=laravel_db(変更)
  DB_USERNAME=laravel_user(変更)
  DB_PASSWORD=laravel_pass(変更)
  ```
  <br>
  mailhogの設定

  ```
  MAIL_MAILER=smtp
  MAIL_HOST=mailhog
  MAIL_PORT=1025
  MAIL_FROM_ADDRESS="送信元アドレス（例：rese@example.com）"
  ```
  <br>
  <img width="406" alt="MailHog設定" src="https://github.com/user-attachments/assets/42b41b17-70d0-4f1d-be26-9caf82cf254d" />
  <br>
  <br>
  stripeのアカウント設定
　<br>
  stripe公式ページ(https://stripe.com/jp)
  <br>
  <img width="406" alt="stripe設定" src="https://github.com/user-attachments/assets/6a374d05-d01c-4e28-9c76-6db77c3046f7" />
  <br>
  <img width="406" alt="stripe設定3" src="https://github.com/user-attachments/assets/d8565489-9daf-4198-8ad4-de9a26cdf7c7" />
  <br>
  
  ```
  STRIPE_KEY=公開可能キーを貼り付け
  STRIPE_SECRET=シークレットキーを貼り付け
  ```

  <br>
  4. アプリケーションキーを取得
  
  ```
  php artisan key:generate
  ```
  
  <br>
  
  5. テーブル作成
  
  ```
  php artisan migrate
  ```

  <br>
  
  6. ダミーデータ作成
  
  ```
  php artisan db:seed
  ```
  

  <br>
  
  7. シンボリックリンク作成
  
  ```
  php artisan storage:link
  ```
  <br>
  ## URL

- 開発環境
  - ログインページ <http://localhost/login>
  - 管理者専用登録ページ <http://localhost/admin/register>
- MailHog <http://localhost:8025>
- phpMyAdmin <http://localhost:8080>



