{{-- AdminLTE Login Page --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
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
            <p class="login-box-msg">Masuk</p>
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
                <div class="input-group mb-3 mt-2">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
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
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat Saya</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </div>
            </form>
            <p class="mb-1 mt-3">
                <a href="{{ route('password.request') }}">Lupa password?</a>
            </p>
            <p class="mb-0">
                <a href="{{ route('register') }}" class="text-center">Daftar akun baru</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
