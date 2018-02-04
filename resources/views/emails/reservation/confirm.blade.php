@component('mail::message')
# Dear {{ $book->customer->name}},

Your reservation has been confirm, Thank you for be with us.

@component('mail::button', ['url' => url('package/'.$book->package->id)])
Click to view
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
