<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar - Sistem Pengajuan Surat</title>
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
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('{{ asset("assets/foto/bg.jpg") }}') no-repeat center center/cover;
            background-attachment: fixed;
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
            background-attachment: fixed;
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
            max-width: 600px;
            color: #fff;
            animation: fadeIn 0.8s ease-in-out;
            margin: 40px 15px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-container img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            background: white;
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 10px;
            padding: 12px 15px;
        }

        /* Karena form-select defaultnya hitam, kita buat transparan untuk teks juga */
        .form-select option {
            background: #1b2b55;
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
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
            font-size: 0.85rem;
            margin-bottom: 5px;
            color: rgba(255, 255, 255, 0.9);
        }

        .login-link {
            color: #b7f8db;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .login-link:hover {
            color: #ffffff;
            text-decoration: underline;
        }
    </style>
</head>

<body>



    <div class="glass-card">
        <div class="text-center logo-container">
            <img src="{{ asset('assets/foto/logo.png') }}" alt="Logo">
        </div>

        <h3 class="text-center fw-bold mb-1">Daftar Akun</h3>
        <p class="text-center small mb-4" style="color: rgba(255,255,255,0.7);">
            SAPURAN Kelurahan Penurunan
        </p>

        <form action="{{ url('registerproses') }}" method="POST">
            @csrf
            
            <div class="row">
                <input type="hidden" name="role" value="Warga">
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda..." required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">No. Telepon / Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Contoh: 08123456789 atau email@domain.com" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jeniskelamin" class="form-select" required>
                        <option value="" selected disabled>-- Pilih --</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Alamat Rumah Area Penurunan</label>
                    <input type="text" name="alamat_jalan" class="form-control" placeholder="Contoh: Jl. Raflesia No. 10" required>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label">RT</label>
                    <input type="text" name="rt" class="form-control" placeholder="001" required>
                </div>

                <div class="col-6 mb-4">
                    <label class="form-label">RW</label>
                    <input type="text" name="rw" class="form-control" placeholder="002" required>
                </div>
            </div>

            <button type="submit" class="btn btn-custom w-100 mb-3">
                Buat Akun Sekarang
            </button>

            <a href="{{ url('/') }}" class="btn w-100 mb-4" style="background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 10px; padding: 12px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'">
                <i class="bi bi-house-door"></i> Kembali ke Beranda
            </a>

            <div class="text-center mt-3">
                <span style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Sudah memiliki akun?</span>
                <a href="{{ url('login') }}" class="login-link">
                    Masuk
                </a>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "{{ session('success') }}",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "{{ session('error') }}",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            let err = '';
            @foreach($errors->all() as $e)
                err += '{{ $e }}\n';
            @endforeach
            Swal.fire({
                icon: "error",
                title: "Validasi Gagal",
                text: err,
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000
            });
        </script>
    @endif

</body>

</html>
