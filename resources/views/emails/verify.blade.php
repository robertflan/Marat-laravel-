@component('mail::message')
# Registrierung abzuschliessen

Sehr geehrter {{ $user->gender }} {{ $user->name }},<br>
bitte klicken Sie hier, um Ihre Registrierung abzuschliessen:

@component('mail::button', ['url' => url('/register/verify/'.$user->activation_code)])
Registrierung abzuschliessen
@endcomponent
<a href="{{ url('/register/verify/'.$user->activation_code) }}">{{ url('/register/verify/'.$user->activation_code) }}</a>

Falls der Link nicht klickbar ist, kopieren Sie den Link in die Browser-Adresszeile und klicken Sie auf
Enter.<br>
Sie haben sich mit folgender Emailadresse registriert: {{ $user->email }}

Bitte beachten Sie, dass diese E-Mail automatisch erzeugt wurde. Antworten auf diese E-Mail werden
nicht an (2 entweder oder Firmennamen) weitergeleitet und können aus diesem Grund nicht
beantwortet werden.

Mit freundlichen Grüßen,<br>
{{ config('app.name') }} Team
@endcomponent
