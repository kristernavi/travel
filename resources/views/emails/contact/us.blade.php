@component('mail::message')
# {{ $client->subject }}

## Client, {{ $client->name}}

{{ $client->message}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
