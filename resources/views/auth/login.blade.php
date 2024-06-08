<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Login</title>
    <link rel="stylesheet" href="css/style-login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Include the necessary Jetstream styles -->
    <link rel="stylesheet" href="{{ asset('vendor/jetstream/css/app.css') }}">
    
</head>

<body>
    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Login</h1>
            <div class="input-box">
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember-forgot">
                <label><x-jet-checkbox id="remember_me" name="remember" />Remember me</label>
                <a href="{{ route('password.request') }}">Forgot password</a>
            </div>
            <x-jet-button type="submit" class="btn">Login</x-jet-button>
            <div class="register-link">
                <p>Have an account <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>
    </div>

    <!-- Include the necessary Jetstream scripts -->
    <script src="{{ asset('vendor/jetstream/js/app.js') }}" defer></script>
</body>

</html>
