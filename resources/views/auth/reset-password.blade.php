<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Reset Password - Sistem Pengajuan Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/foto/logo.png') }}" type="image/png">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset("assets/foto/bg.jpg") }}') no-repeat center center/cover;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(80, 167, 194, 0.8), rgba(27, 43, 85, 0.9));
            z-index: -1;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            color: #fff;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            background: white;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 10px;
            padding: 12px 15px;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #50a7c2;
            color: #fff;
            box-shadow: 0 0 0 0.25rem rgba(80, 167, 194, 0.25);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-custom {
            background: #50a7c2;
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #3a859c;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(80, 167, 194, 0.4);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>

<body>

    <div class="glass-card">
        <div class="text-center logo-container">
            <img src="{{ asset('assets/foto/logo.png') }}" alt="Logo">
        </div>

        <h3 class="text-center fw-bold mb-1">Reset Password</h3>
        <p class="text-center small mb-4" style="color: rgba(255,255,255,0.7);">
            Silakan masukkan password baru Anda.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger" style="background: rgba(220, 53, 69, 0.2); border: 1px solid rgba(220, 53, 69, 0.5); color: #fff;">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Email Anda</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.7);">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <input type="email" name="email" value="{{ $email ?? old('email') }}" class="form-control border-start-0" readonly required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.7);">
                        <i class="bi bi-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-end-0" style="border-color: rgba(255,255,255,0.3); color: rgba(255,255,255,0.7);">
                        <i class="bi bi-lock-fill"></i>
                    </span>
                    <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-custom w-100 mb-3">
                Reset Password
            </button>
        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
