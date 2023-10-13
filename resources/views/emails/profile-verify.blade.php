<x-mail::message>
Dear {{ $profile->name }}, <br/>

Your KYC status has been {{ $profile->kyc_status==1?'Approved':'Rejected'}}.<br>
You can connect with support team for any further queries & help!

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>