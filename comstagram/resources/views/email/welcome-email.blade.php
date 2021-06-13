@component('mail::message')
# Welcome to comstagram.

Comstagram에 가입해 주셔서 감사합니다. 

라라벨 공부에 계속 정진하기 바랍니다.

여러분의 행운을 빕니다.

From scpark.


@component('mail::button', ['url' => 'http://localhost:8000/profile/'.$userId])
내 프로필 가기
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
