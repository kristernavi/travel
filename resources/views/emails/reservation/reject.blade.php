@component('mail::message')
# Dear {{ $book->customer->name}},

Unfortunately your reservation was been rejected,
Due for some reason. Dont worry you will be refunded. Please keep on touching on us.

@component('mail::button', ['url' => url('package/'.$book->package->id)])
Click to view
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
