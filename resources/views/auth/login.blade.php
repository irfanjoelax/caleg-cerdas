<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset(env('APP_LOGO')) }}" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- fontawesome core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>

<body>
    <form class="form-signin" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-2" src="{{ asset(env('APP_LOGO')) }}" class="" width="90">
            <h2 class="mb-3 fw-bold">
                {{ env('APP_NAME') }}
            </h2>
        </div>

        <div class="form-label-group">
            <input type="text" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                placeholder="Email address" required autofocus>
            <label for="inputemail">Email address</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
            <label for="inputPassword">Password</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button class="btn btn-lg btn-primary w-100" type="submit">
            <i class="fa fa-unlock-alt"></i> &nbsp; Sign in
        </button>

        <p class="mt-5 mb-3 text-muted text-center">
            Powered by <strong class="text-primary">{{ env('APP_COPYRIGHT') }}</strong> &copy; {{ date('Y') }}
        </p>
    </form>
</body>

</html>
