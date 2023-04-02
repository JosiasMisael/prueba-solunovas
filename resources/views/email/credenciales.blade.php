@component('mail::message')
# Bienvenido {{$user->name}}

 Tus credenciales para acceder a  {{ config('app.name') }}

 @component('mail::table')
    |  Username | Contraseña |
    |:-----------|:------------|
    | {{$user->email}} | {{$password}} |
 @endcomponent

@component('mail::button', ['url' => url('login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
