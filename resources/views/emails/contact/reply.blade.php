@component('mail::message')
# Hello {{ $name }},

Thank you for contacting us. Here is our response to your inquiry:

@component('mail::panel')
{{ $replyMessage }}
@endcomponent

## Your Original Message:
@component('mail::panel')
{{ $originalMessage }}
@endcomponent

Thank you for choosing {{ config('app.name') }}!

Best regards,<br>
The {{ config('app.name') }} Team
@endcomponent 