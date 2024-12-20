<!DOCTYPE html>
<html>
<head>
    <title>Reseからのお知らせ</title>
</head>
<body>
    <h1>Reseからのお知らせ</h1>
    <p>いつもReseをご利用いただきありがとうございます。</p>
    <br>
    <div>{!! nl2br(e($text)) !!}</div>
    <br>
    <p>Thanks,{{ config('app.name') }}</p>
</body>