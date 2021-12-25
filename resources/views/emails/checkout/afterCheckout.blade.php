@component('mail::message')
# Anda telah berhasil melakukan checkout pada kursus {{  $userCheckout->camp->title }} <br>

Hay.. {{ $userCheckout->user->name }} <br>
Anda belum melakukan pembayaran pada kelas <b>{{ $userCheckout->camp->title }}</b> <br>
@component('mail::panel')
    Satatus pembayaran anda saat ini <b>Sedang Menunggu Pembayaran</b>
@endcomponent
<br>
@component('mail::panel')
Silahkan melakukan pembayaran agar bisa mengakses kursus yang kamu pilih
@endcomponent

@component('mail::button', ['url' => route('dashboard-laracamp'), 'color' => 'primary'])
Lihat Dashboard
@endcomponent

Thanks,<br> <br>
{{ config('app.name') }}
@endcomponent
