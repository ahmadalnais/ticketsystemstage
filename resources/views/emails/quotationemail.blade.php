@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent
<a href="{{ route('pdf', ['quotation_id' => $quotation->id]) }}">pdf</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
