@component('mail::message')
# Your Transaction Has Been Confirmed

Hi, {{ $checkout->user->name }}.
<br>
Your transaction has been confirmed, now you can enjoy the benefits of <b>{{ $checkout->camp->title }}</b>

@component('mail::button', ['url' => route('dashboard.user')])
My Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
