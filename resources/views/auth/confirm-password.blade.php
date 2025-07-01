{{-- AdminLTE Confirm Password Page --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>SAO</b>App</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Please confirm your password before continuing.</p>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            </p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
</body>
</html>
