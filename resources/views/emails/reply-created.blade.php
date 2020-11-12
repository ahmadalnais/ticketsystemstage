@component('mail::message')
Beste {{ $reply->ticket->project->user->name }},
# {{ preg_replace("/<div>(.*?)<\/div>/", "$1", $reply->description) }}<br>

#Status: {{ $reply->ticket->status }}<br>
#Het kost tijd: {{ $reply->hours }} uur/uren.<br><br><br>

{{-- @component('mail::button', ['url' => config('app.url') . "nova/resources/replies/$reply->id"])
Reply bekijken
@endcomponent --}}

Met vriendelijk groet,<br><br>

Melvin Tehubijuluw | Fullstack Developer<br>
Eric Landheer | Fullstack Developer<br>
MEN Technology & Media<br>
<img src="https://mentechmedia.nl/images/logo.png" alt="no logo">
@endcomponent
