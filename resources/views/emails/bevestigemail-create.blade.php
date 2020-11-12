@component('mail::message')
Beste {{ $user->name }}, <br><br>
We hebben een account voor u gemaakt.<br>
Om uw account te bekijken klik hier onder.<br>
Klik daarna op (Forget Your Password) om een nieuw wachtwoord toe te voegen.<br>

User name: {{ $user->email }}
@component('mail::button', ['url' => config('app.url') . "nova/login"])
Account Bekijken
@endcomponent



Met vriendelijk groet,<br><br>

Melvin Tehubijuluw | Fullstack Developer<br>
Eric Landheer | Fullstack Developer<br>
MEN Technology & Media<br>
<img src="https://mentechmedia.nl/images/logo.png" alt="no logo">
@endcomponent
