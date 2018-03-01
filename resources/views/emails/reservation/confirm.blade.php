@component('mail::message')
# Dear {{ $book->customer->name}},

Your reservation has been confirm, Thank you for be with us.

@if($book->package != null)
@component('mail::button', ['url' => url('package/'.$book->package->id)])
Click to view
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
