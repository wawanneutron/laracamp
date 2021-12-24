@component('mail::message')
# Selamat Datang!

Hay {{ $user->name }}
<br>
Selamat datang di bootcamp Laracamp, akun kamu sudah berhasil terdaftar.
<br>
Sekarang kamu dapat memilih kursus terbaik yang kamu suka.
@component('mail::panel')
Silahkan cari kursus yang kamu suka.
@endcomponent

@component('mail::button', ['url' => route('login')])
Login Sekarang
@endcomponent
<br>
Terimakasih,<br>
{{ config('app.name') }}
@endcomponent
