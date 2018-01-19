@component('mail::message')
# Dear, {{ $user->name }}


{{$user->actived ? 'Your Account was successfully activeted': 'Sorry we temporarily Inactive your account'}}

Click here to login

@component('mail::button', ['url' => 'login'])
Login Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
