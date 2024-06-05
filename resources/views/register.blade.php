@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p class="text-center" style="margin-top: -30px;"><img src="{{asset('img/hmjti1.png')}}" width="150px"  alt=""></p>
            <h6 class="text-center py-4" style="margin-top: -40px; margin-bottom: 20px;"><b>Peminjaman Ruangan & Barang <br>Jurusan Bisnis dan Informatika</b></h6>
                <div class="col-md-8" style="font-size:14px;">

            <form id="registerForm" action="{{ route('register')}}" method="POST">
                @csrf

                <!-- Kolom NIM dengan validasi JavaScript -->
                <div class="row mb-3">
                    <label for="nim" class="col-md-4 col-form-label text-md-end">{{ __('NIM') }}</label>

                    <div class="col-md-5" style="position: relative;">
                        <input id="nim" type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autocomplete="nim" autofocus placeholder="Masukkan NIM" style="font-size:14px;">

                        <div id="nim-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                        <script>
                            document.getElementById('nim').addEventListener('input', function () {
                                var nimInput = this.value.trim();
                                var alertDiv = document.getElementById('nim-alert');
                                
                                // Reset the alert
                                alertDiv.innerHTML = '';

                                // Check if NIM is empty
                                if (nimInput === '') {
                                    alertDiv.innerHTML = '* NIM tidak boleh kosong';
                                    return;
                                }
                                
                                // Check if NIM is not numeric
                                if (!/^\d+$/.test(nimInput)) {
                                    alertDiv.innerHTML = '* NIM harus berupa angka';
                                    return;
                                }

                                // Check if NIM does not start with "36" or if it's not exactly "36"
                                if (nimInput !== '36' && !nimInput.startsWith('36')) {
                                    alertDiv.innerHTML = '* NIM yang anda masukkan tidak sesuai';
                                    return;
                                }

                                // Check if NIM is not exactly 12 digits
                                if (nimInput.length !== 12) {
                                    alertDiv.innerHTML = '* NIM harus terdiri dari 12 digit';
                                    return;
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Kolom Nama Mahasiswa dengan validasi JavaScript -->
                <div class="row mb-3">
                    <label for="nama_mahasiswa" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                    <div class="col-md-5" style="position: relative;">
                        <input id="nama_mahasiswa" type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}" required autocomplete="nama_mahasiswa" autofocus placeholder="Masukkan Nama Mahasiswa" style="font-size:14px;">

                        <div id="nama-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                        <script>
                            document.getElementById('nama_mahasiswa').addEventListener('input', function () {
                                var namaInput = this.value.trim();
                                var alertDiv = document.getElementById('nama-alert');
                                
                                // Reset the alert
                                alertDiv.innerHTML = '';

                                // Check if nama is empty
                                if (namaInput === '') {
                                    alertDiv.innerHTML = '* Nama tidak boleh kosong';
                                    return;
                                }
                                
                                // Check if nama contains only letters and spaces
                                if (!/^[a-zA-Z\s]+$/.test(namaInput)) {
                                    alertDiv.innerHTML = '* Nama harus berupa huruf dan spasi';
                                    return;
                                }
                            });
                        </script>
                    </div>
                </div>


                <!-- Kolom Password dengan validasi JavaScript -->
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-5" style="position: relative;">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" placeholder="Masukkan Password" style="font-size:14px;">

                        <div id="password-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                        <script>
                            document.getElementById('password').addEventListener('input', function () {
                                var passwordInput = this.value.trim();
                                var alertDiv = document.getElementById('password-alert');

                                // Reset the alert
                                alertDiv.innerHTML = '';

                                // Check if password is empty
                                if (passwordInput === '') {
                                    alertDiv.innerHTML = '* Password tidak boleh kosong';
                                } else if (passwordInput.length < 8) {
                                    alertDiv.innerHTML = '* Password minimal 8 karakter';
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Tombol Register -->
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="button" class="btn btn-primary" onclick="validateAndSubmit()">
                            {{ __('Daftar') }}
                        </button>
                        <span class="ms-3">Sudah punya akun?</span> 
                        <a href="{{ route('login') }}"><span>Masuk</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateAndSubmit() {
        var nimInput = document.getElementById('nim').value.trim();
        var namaInput = document.getElementById('nama_mahasiswa').value.trim();
        var passwordInput = document.getElementById('password').value.trim();


        // Check if all validations pass
        if (
            nimInput !== '' &&
            /^[0-9]+$/.test(nimInput) &&
            nimInput.length === 12 &&
            namaInput !== '' &&
            /^[a-zA-Z\s]+$/.test(namaInput) &&
            passwordInput !== '' &&
            passwordInput.length >= 8
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