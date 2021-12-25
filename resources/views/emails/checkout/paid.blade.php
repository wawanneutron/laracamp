@component('mail::message')
# Transaksi kamu sudah terverifikasi <br>

Hay.. {{ $paid->user->name }} <br>
Transaksi kamu sudah terkonfirmasi, seakrang kamu dapat melakukan pembelajaran pada <b>{{ $paid->camp->title }}</b> <br>
<br>

@component('mail::button', ['url' => route('user.dashboard'), 'color' => 'primary'])
My Dashboard
@endcomponent

Thanks,<br> <br>
{{ config('app.name') }}
@endcomponent
