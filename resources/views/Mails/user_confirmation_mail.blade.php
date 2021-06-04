<h1>{{ config('app.name') }}</h1>
<p>Hello, {{ $user->username }}, Registration has been successfully completed.</p>
<p>Please verify your email address by clicking the button below.
    <a href="{{ config('app.url') }}/user/confirm/{{ $user->activation_key }}" class="btn btn-primary">
        Confirm Email
    </a>
</p>
<p>{{ config('app.url') }}/user/confirm/{{ $user->activation_key }}</p>
