@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p class="text-center" style="margin-top: 30px;"><img src="{{ asset('img/hmjti1.png') }}" width="150px" alt=""></p>
        <h6 class="text-center py-4" style="margin-top: -20px; margin-bottom: 40px;"><b>Peminjaman Ruangan & Barang <br>Jurusan Bisnis dan Informatika</b></h6>
        <div class="col-md-8" style="font-size:14px;">
            
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Menampilkan Pesan Kesalahan -->
                @error('nama_admin_or_nim')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Kolom Username -->
                <div class="row mb-3">
                    <label for="nama_admin_or_nim" class="col-md-4 col-form-label text-sm-end">{{ __('Username') }}</label>
                    <div class="col-md-5">
                        <input id="nama_admin_or_nim" type="text" class="form-control @error('nama_admin_or_nim') is-invalid @enderror" placeholder="Masukkan Username" name="nama_admin_or_nim" value="{{ old('nama_admin_or_nim') }}" required autocomplete="nama_admin_or_nim" autofocus style="font-size:14px;">
                        
                        <div id="nama_admin_or_nim-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                        <script>
                            document.getElementById('nama_admin_or_nim').addEventListener('input', function () {
                                var nama_admin_or_nimInput = this.value.trim();
                                var alertDiv = document.getElementById('nama_admin_or_nim-alert');
                                
                                // Reset the alert
                                alertDiv.innerHTML = '';

                                // Check if NIM is empty
                                if (nama_admin_or_nimInput === '') {
                                    alertDiv.innerHTML = '* Username tidak boleh kosong';
                                    return;
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Kolom Password -->
                <div class="row mb-3" >
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                    <div class="col-md-5">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan Password" style="font-size:14px;">
                        
                        <div id="password-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                        <script>
                            document.getElementById('password').addEventListener('input', function () {
                                var passwordInput = this.value.trim();
                                var alertDiv = document.getElementById('password-alert');
                                
                                // Reset the alert
                                alertDiv.innerHTML = '';

                                // Check if NIM is empty
                                if (passwordInput === '') {
                                    alertDiv.innerHTML = '* Password tidak boleh kosong';
                                    return;
                                }
                            });
                        </script>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Masuk') }}
                        </button>
                        <span class="ms-3">Belum punya akun?</span> 
                        <a href="{{ route('register') }}"><span>Daftar</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAndSubmit() {
        var nama_admin_or_nimInput = document.getElementById('nama_admin_or_nim').value.trim();
        var passwordInput = document.getElementById('password').value.trim();


        // Check if all validations pass
        if (
            nama_admin_or_nimInput !== '' &&

            passwordInput !== '' &&
        ) {
            // If validations pass, submit the form
            document.getElementById('registerForm').submit();
        } else {
            // If validations fail, display an alert
            alert('Validasi gagal. Periksa kembali isian formulir Anda.');
        }
    }
</script>
@endsection
