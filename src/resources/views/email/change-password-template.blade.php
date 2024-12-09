<!DOCTYPE html>
<html>
<head>
    <title>店舗管理者登録完了のお知らせ</title>
</head>
<body>
    <h1>Reseからのお知らせ</h1>
    <h2> {{ $editor->name }} 様</h2>
    <br>

    <p>Reseをご利用いただきありがとうございます。</p>
    <p>管理者より、{{ $editor->name }} 様の店舗代表者登録が完了しましたのでご連絡します。</p>
    <p>現在、仮パスワードで登録しておりますので、ご本人様にて本パスワードの登録をお願い致します。</p>
    <ul>
        <li>email： {{ $editor->email }}</li>
        <li>仮パスワード： {{ $editor->password }}</li>
        <li>店舗： {{ $shop_name }}</li>
    </ul>

    <br>
    <p>-----本パスワード登録手順-----</p>
    <p>①以下のリンクよりログインしますと、メールアドレス認証画面に移ります。</p>
    <p>②送信されたメールに記載の『認証』ボタンをクリック</p>
    <p>③パスワード変更画面に移りますので、本パスワード登録</p>
    <br>
    <a href="{{url('/editor/change')}}">ログイン</a>
    <br>
    <p>----------------------------</p>
    <br>

    <p>どうぞ、よろしくお願い致します。</p>


    <p>Thanks,{{ config('app.name') }}</p>
</body>