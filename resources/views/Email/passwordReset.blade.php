@component('mail::message')
# Cambio de contraseña

Haga clic en el botón de abajo para cambiar la contraseña.

@component('mail::button', ['url' => 'http://localhost:4200/response-password-reset?token='.$token])
Restablecer contraseña
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent