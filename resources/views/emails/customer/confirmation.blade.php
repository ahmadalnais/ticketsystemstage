@component('mail::message')
Beste {{ $ticket->project->user->name }} ,<br>
U ontvangt deze e-mail ter bevestiging van het probleem dat u aan ons hebt gemeld.
Wij nemen zo spoedig mogelijk contact met u op.

<div style="text-align: left">
	<div style="display: inline-block;">
		@component('mail::button', ['url' => config('app.url') . "nova/resources/tickets/$ticket->id"])
		Ticket bekijken of aanpassen
		@endcomponent
	</div>
</div>
Met vriendelijk groet,<br><br>

Melvin Tehubijuluw | Fullstack Developer<br>
Eric Landheer | Fullstack Developer<br>
MEN Technology & Media<br>
<img src="https://mentechmedia.nl/images/logo.png" alt="no logo">
@endcomponent
