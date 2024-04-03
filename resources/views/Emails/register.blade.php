@component('mail::message')

<p>Hello {{ $customer->first_name }}</p>

@component ('mail::button', ['url' => url('verify/'.$customer->remember_token)])
Verify
@endcomponent

<p>In case you have issues. Please contact our contact us.</p>

Thanks <br />
{{ config('app.name') }}

@endcomponent