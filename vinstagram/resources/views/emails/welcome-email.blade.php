@component('mail::message')
# Welcome {{ $user->username }}

<h1>Welecome to scparkInstagram!</h1>

@component('mail::button', ['url' => '/dashboard'])
Home
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
