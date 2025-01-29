<head>
    <title>Halaman Pendaftaran</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/register-konsumen.css') }}">
</head>

<body>
    <div class="container">
        <!-- Left Section with Image -->
        <div class="image-section">
            <img src="{{ asset('assets/banner_signup2.jpg') }}" alt="Banner Signup">
            <div class="welcome-text">
                Hai, senang bertemu denganmu! Silakan isi formulir untuk mendaftar.
            </div>
        </div>

        <!-- Right Section with Form -->
        <div class="form-section">
            <h1>Daftar</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" :value="old('nama')" required>
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone" id="phone" placeholder="Nomor Telepon" required>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email" :value="old('email')" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Kata Sandi" required>
                    <h3 class="password-instructions">
                        *Kata Sandi harus terdiri minimal 8 karakter dengan angka, huruf besar, huruf kecil, atau
                        simbol (!@#$).
                    </h3>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Konfirmasi Kata Sandi" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group">
                    <input type="checkbox" id="terms" name="terms" style="width: auto;" required>
                    <label for="terms">Saya telah membaca dan menyetujui ketentuan</label>
                </div>

                <!-- Register Button -->
                <button type="submit">Daftar</button>
            </form>

            <div class="login-link">
                Sudah mempunyai akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>
</body>