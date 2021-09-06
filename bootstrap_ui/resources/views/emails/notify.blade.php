@component('mail::message')
    # Introduction

    Thank you for using our service

    @component('mail::button', ['url' => 'scpark@yju.ac.kr'])
        reply email
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
