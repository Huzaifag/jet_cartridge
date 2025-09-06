@component('mail::message')
# Welcome to {{ config('app.name') }}

Dear {{ $accountPerson->name }},

Your account has been created successfully. Here are your login credentials:

**Email:** {{ $accountPerson->email }}
**Password:** {{ $accountPerson->visible_password }}

Please change your password after your first login for security purposes.

@component('mail::button', ['url' => route('login')])
Login Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent 