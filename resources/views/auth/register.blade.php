{{-- AdminLTE Register Page --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="/"><b>SAO</b>App</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Daftar akun baru</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                @error('name')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
                <div class="input-group mb-3 mt-2">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
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
                <div class="input-group mb-3 mt-2">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
                <div class="row mt-3">
                    <div class="col-8">
                        <a href="{{ route('login') }}" class="text-center">Sudah punya akun?</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
