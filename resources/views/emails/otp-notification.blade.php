<x-mail::message>
Dear {{ $user->name }}, <br/>

Your One Time Password for <strong>TheFitApp</strong> is {{ $OTPCode }}.<br>
OTP is valid for 10 mintues only.<br/><br/>

Do not share this OTP with anyone.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>