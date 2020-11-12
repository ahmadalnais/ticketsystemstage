@component('mail::message')
# New Ticket: {{ $ticket->title }}

# Beschrijving: {{ preg_replace("/<div>(.*?)<\/div>/", "$1", $ticket->description) }}
# Url: {{ $ticket->url }}
# Device: {{ $ticket->device }}
# Device Type: {{ $ticket->type }}
# Device Name: {{ $ticket->device_name }}
# Browser Name: {{ $ticket->browser }}
# Browser Name: {{ $ticket->version_number }}

@component('mail::button', ['url' => config('app.url') . "nova/resources/tickets/$ticket->id"])
Ticket bekijken
@endcomponent
 
Met vriendelijk groet,<br><br>
{{ $ticket->project->user->name }}<br>
{{ $ticket->project->user->company_name }}<br>

@endcomponent
