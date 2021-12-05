@component('mail::message')

@component('mail::button', ['url' => ''])

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
