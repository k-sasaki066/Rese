@component('mail::message')
# Reseからのお知らせ

{{ $text }}

Thanks,{{ config('app.name') }}
@endcomponent