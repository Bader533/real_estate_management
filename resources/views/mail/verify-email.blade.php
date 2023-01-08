@component('mail::message')
# Welcome ,{{$name}}

Verify Your Email .
@component('mail::panel')
Verification Code is : {{$code}}
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
