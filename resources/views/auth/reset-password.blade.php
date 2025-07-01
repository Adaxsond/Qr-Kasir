{{-- AdminLTE Reset Password Page --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password</title>
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
            <p class="login-box-msg">Atur ulang password Anda</p>
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                @if(isset($token) && $token === null)
                    <input type="hidden" name="token" value="direct">
                @else
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                @endif
                {{-- Email tidak perlu diinput, hanya hidden jika ada --}}
                @if(isset($email))
                    <input type="hidden" name="email" value="{{ $email }}">
                @endif
                <div class="input-group mb-3 mt-2">
                    <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
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
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password Baru" required>
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
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Atur Ulang Password</button>
                    </div>
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Masuk</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
