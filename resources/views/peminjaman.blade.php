<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Peminjamam Ruangan & Barang</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

  <form method="POST" action="/peminjaman">
    @csrf

  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:100px;">
      <div class="container-fluid" style="margin-right: 50px;">
          <a href="#beranda">
              <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" style="height: 50px; margin-left: 50px;">
          </a>
          <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                  <a class="nav-link text-light" href="inforuangan-mahasiswa" style="font-family:roboto;">Info Ruangan</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-dark" href="#" style="margin-left: 100px; font-family:roboto;">Peminjaman Ruangan & Barang</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-light" href="riwayat-list-mahasiswa" style="margin-left: 100px; font-family:roboto;">Riwayat</a>
              </li>
          </ul>
          <a href="#notifikasi">
              <img src="{{ asset('img/notif.svg') }}" alt="Logo Notifikasi" style="height: 25px; margin-right: 30px;">
          </a>
      </div>
      <div>
    </div>
    </nav>

      <!-- judul fitur -->
      <div class="container" style="margin-top: 30px;">
      <p class="h4">Form Peminjaman Ruangan & Barang</p></div>

      <!-- pilihan tanggal -->
      <div class="row mb-3" style="margin-top: 40px; margin-left: 50px;">
        <label for="tanggal" class="col-md-4 col-form-label text-md-end">{{ __('Tanggal') }}</label>
        <div class="col-sm-2">
          <input type="date" class="form-control" name="tanggal" id="tanggal">

            <script>
                document.getElementById('tanggal').addEventListener('change', function () {
                    var tanggalInput = this.value.trim();
                    var alertDiv = document.getElementById('tanggal-alert');

                    // Reset pemberitahuan
                    alertDiv.innerHTML = '';

                    // Validasi tanggal
                  if (tanggalInput === '' || tanggalInput === 'Pilih Tanggal') {
                      alertDiv.innerHTML = '* Tanggal harus dipilih';
                      return;
                  }
                });
            </script>
        </div>
      </div>
      
      
      <!-- Dropdown jam peminjaman -->
      <div class="row mb-3" style="margin-left: 50px;">
        <label for="jam_peminjaman" class="col-md-4 col-form-label text-md-end">{{ __('Jam Peminjaman') }}</label>

        <div class="col-md-4">
            <select class="form-select @error('jam_peminjaman') is-invalid @enderror" aria-label="Pilih Jam Peminjaman" name="jam_peminjaman" id="jam_peminjaman">
                <option disabled selected>Pilih Jam Peminjaman</option>
                <option value="07.30">07.30</option>
                <option value="08.20">08.20</option>
                <option value="09.10">09.10</option>
                <option value="10.00">10.00</option>
                <option value="10.50">10.50</option>
                <option value="12.30">12.30</option>
                <option value="13.20">13.20</option>
                <!-- opsi "Input Baru" -->
                <option value="newOption">Lainnya...</option>
            </select>

            <div id="newInputPeminjaman" style="display: none;">
                <input type="text" class="form-control" id="newJamPeminjaman" placeholder="Masukkan Jam Peminjaman Baru" name="newJamPeminjaman">
                <div id="jam_peminjaman-alert" class="invalid-feedback"></div>
            </div>

            <script>
                document.getElementById('jam_peminjaman').addEventListener('change', function () {
                    var newJamPeminjamanInput = this.value.trim();
                    var jam_peminjaman = this.value.trim();
                    var alertDiv = document.getElementById('newJamPeminjamanInput-alert');
                    var alertDiv = document.getElementById('jam_peminjaman-alert');
                    var newInputDiv = document.getElementById('newInputPeminjaman');

                    // Reset pemberitahuan
                    alertDiv.innerHTML = '';

                    // menampilkan input teks baru jika opsi "Input Baru" dipilih
                    if (newJamPeminjamanInput === 'newOption') {
                        newInputDiv.style.display = 'block';
                    } else {
                        newInputDiv.style.display = 'none';
                    }

                    // Validasi dropdown
                    if (jam_peminjaman === '' || jam_peminjaman === 'Pilih Jam Pengembalian') {
                        alertDiv.innerHTML = '* Jam Pengembalian harus dipilih';
                        return;
                    }
                    // Validasi inputan
                    if (newJamPeminjamanInput === '' || newJamPeminjamanInput === 'Pilih Jam Pengembalian') {
                        alertDiv.innerHTML = '* Jam Pengembalian harus dipilih';
                        return;
                    }
                });
            </script>
        </div>
      </div>


      <!-- Dropdown jam pengembalian -->
      <div class="row mb-3" style="margin-left: 50px;">
        <label for="jam_pengembalian" class="col-md-4 col-form-label text-md-end">{{ __('Jam Pengembalian') }}</label>

        <div class="col-md-4">
            <select class="form-select @error('jam_pengembalian') is-invalid @enderror" aria-label="Pilih Jam Pengembalian" name="jam_pengembalian" id="jam_pengembalian">
                <option disabled selected>Pilih Jam Pengembalian</option>
                <option value="08.20">08.20</option>
                <option value="09.10">09.10</option>
                <option value="10.00">10.00</option>
                <option value="10.50">10.50</option>
                <option value="11.40">11.40</option>
                <option value="13.20">13.20</option>
                <option value="14.10">14.10</option>
                <!-- opsi "Input Baru" -->
                <option value="newOption">Lainnya...</option>
            </select>

            <div id="newInputPengembalian" style="display: none;">
                <input type="text" class="form-control" id="newJamPengembalian" placeholder="Masukkan Jam Pengembalian Baru" name="newJamPengembalian">
                <div id="jam_pengembalian-alert" class="invalid-feedback"></div>
            </div>

            <!-- Script untuk dropdown jam pengembalian -->
            <script>
              document.getElementById('jam_pengembalian').addEventListener('change', function () {
                  var newJamPengembalianInput = this.value.trim();
                  var jam_pengembalian = this.value.trim();
                  var alertDiv = document.getElementById('newJamPengembalianInput-alert');
                  var alertDiv = document.getElementById('jam_pengembalian-alert');
                  var newInputDiv = document.getElementById('newInputPengembalian');

                  // Reset pemberitahuan
                  alertDiv.innerHTML = '';

                  // menampilkan input teks baru jika opsi "Input Baru" dipilih
                  if (newJamPengembalianInput === 'newOption') {
                      newInputDiv.style.display = 'block';
                  } else {
                      newInputDiv.style.display = 'none';
                  }

                  // Validasi kelas
                  if (jam_pengembalian === '' || jam_pengembalian === 'Pilih Jam Pengembalian') {
                      alertDiv.innerHTML = '* Jam Pengembalian harus dipilih';
                      return;
                  }
                      // Validasi kelas
                  if (newJamPengembalianInput === '' || newJamPengembalianInput === 'Pilih Jam Pengembalian') {
                      alertDiv.innerHTML = '* Jam Pengembalian harus dipilih';
                      return;
                  }
              });
            </script>
        </div>
      </div>

      
        <!-- drop down nama dosen -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="nama_dosen" class="col-md-4 col-form-label text-md-end">{{ __('Dosen') }}</label>

        <div class="col-md-4">
          <select class="form-select" id="nama_dosen" name="nama_dosen" autocomplete="off">
              <option disabled selected>Pilih Dosen</option>
              @foreach($dosens as $dosen)
              <option value="{{ $dosen }}">{{ $dosen }}</option>
              @endforeach
          </select>

            <script>
                document.getElementById('nama_dosen').addEventListener('change', function () {
                    var nama_dosenInput = this.value.trim();
                    var alertDiv = document.getElementById('nama_dosen-alert');

                    // Reset pemberitahuan
                    alertDiv.innerHTML = '';

                    // Validasi kelas
                  if (nama_dosenInput === '' || nama_dosenInput === 'Pilih Nama Dosen') {
                      alertDiv.innerHTML = '* Nama Dosen harus dipilih';
                      return;
                  }
                });
            </script>
        </div>
      </div>


        <!-- drop down nama mata kuliah -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="nama_matakuliah" class="col-md-4 col-form-label text-md-end">{{ __('Mata Kuliah') }}</label>

        <div class="col-md-4">
          <select class="form-select" id="nama_matakuliah" name="nama_matakuliah" autocomplete="off">
              <option disabled selected>Pilih Mata Kuliah</option>
              @foreach($matkuls as $matkul)
              <option value="{{ $matkul }}">{{ $matkul }}</option>
              @endforeach
          </select>

              <script>
                  document.getElementById('nama_matakuliah').addEventListener('change', function () {
                      var nama_matakuliahInput = this.value.trim();
                      var alertDiv = document.getElementById('nama_matakuliah-alert');

                      // Reset pemberitahuan
                      alertDiv.innerHTML = '';

                      // Validasi kelas
                    if (nama_matakuliahInput === '' || nama_matakuliahInput === 'Pilih Mata Kuliah') {
                        alertDiv.innerHTML = '* Mata Kuliah harus dipilih';
                        return;
                    }
                  });
              </script>
        </div>
      </div>


        <!-- drop down ruangan -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="ruangan" class="col-md-4 col-form-label text-md-end">{{ __('Ruangan') }}</label>

        <div class="col-md-4">
          <select class="form-select" id="ruangan" name="ruangan" autocomplete="off">
              <option disabled selected>Pilih Ruangan</option>
              @foreach($ruangans as $ruangan)
              <option value="{{ $ruangan }}">{{ $ruangan }}</option>
              @endforeach
          </select>

              <script>
                  document.getElementById('ruangan').addEventListener('change', function () {
                      var ruanganInput = this.value.trim();
                      var alertDiv = document.getElementById('ruangan-alert');

                      // Reset pemberitahuan
                      alertDiv.innerHTML = '';

                      // Validasi kelas
                    if (ruanganInput === '' || ruanganInput === 'Pilih Ruangan') {
                        alertDiv.innerHTML = '* Ruangan harus dipilih';
                        return;
                    }
                  });
              </script>
        </div>
      </div>


        <!-- drop down barang 1 -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="barang1" class="col-md-4 col-form-label text-md-end">{{ __('Barang 1') }}</label>
          
          <div class="col-md-4">
              <select class="form-select barang-dropdown" id="barang1" name="barang1" autocomplete="off">
                  <option disabled selected value="">Pilih Barang 1</option>
                  @foreach($barangs as $barang)
                    <option value="{{ $barang->nama_barang }}-{{ $barang->merek_barang }}">
                        {{ $barang->nama_barang }} - {{ $barang->merek_barang }}
                    </option>
                  @endforeach
              </select>
          </div>
      </div>
  

        <!-- drop down barang 2 -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="barang2" class="col-md-4 col-form-label text-md-end">{{ __('Barang 2') }}</label>
          
          <div class="col-md-4">
              <select class="form-select barang-dropdown" id="barang2" name="barang2" autocomplete="off">
                  <option disabled selected value="">Pilih Barang 2</option>
                  @foreach($barangs as $barang)
                    <option value="{{ $barang->nama_barang }}-{{ $barang->merek_barang }}">
                        {{ $barang->nama_barang }} - {{ $barang->merek_barang }}
                    </option>
                  @endforeach
              </select>
          </div>
      </div>


        <!-- drop down barang 3 -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="barang3" class="col-md-4 col-form-label text-md-end">{{ __('Barang 3') }}</label>
          
          <div class="col-md-4">
              <select class="form-select barang-dropdown" id="barang3" name="barang3" autocomplete="off">
                  <option disabled selected value="">Pilih Barang 3</option>
                  @foreach($barangs as $barang)
                      <option value="{{ $barang->nama_barang }}-{{ $barang->merek_barang }}">
                          {{ $barang->nama_barang }} - {{ $barang->merek_barang }}
                      </option>
                    @endforeach
              </select>
          </div>
      </div>

      <script>
        // mendefinisikan fungsi untuk memuat ulang opsi dropdown
        function refreshDropdownOptions(selectedDropdown, selectedValue) {
            $(".barang-dropdown").not(selectedDropdown).each(function() {
                var dropdown = $(this);
                dropdown.find("option").prop("disabled", false); // Enable all options
    
                // men-disable opsi yang sudah dipilih di dropdown lain
                dropdown.find('option[value="' + selectedValue + '"]').prop("disabled", true);
    
                // menghapus opsi yang dinonaktifkan (opsi yang sudah dipilih) dari dropdown
                dropdown.find('option:disabled').remove();
            });
        }
    
        // menambahkan event listener pada perubahan nilai dropdown
        $(".barang-dropdown").change(function() {
            var selectedDropdown = $(this);
            var selectedValue = selectedDropdown.val();
    
            // memuat ulang opsi dropdown lainnya
            refreshDropdownOptions(selectedDropdown, selectedValue);
        });
    </script>

    
        <!-- kolom isian nama peminjam beserta allert-->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="nama_peminjam" class="col-md-4 col-form-label text-md-end">{{ __('Nama Peminjam') }}</label>

            <div class="col-md-4">
              <input id="nama_peminjam" type="text" class="form-control @error('nama_peminjam') is-invalid @enderror" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required autocomplete="nama_peminjam" autofocus placeholder="Masukkan Nama Peminjam" style="font-size:14px;">

              <div id="nama_peminjam-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                <script>
                    document.getElementById('nama_peminjam').addEventListener('input', function () {
                        var nama_peminjamInput = this.value.trim();
                        var alertDiv = document.getElementById('nama_peminjam-alert');
                        
                        // Reset the alert
                        alertDiv.innerHTML = '';

                        // Check if NIM is empty
                        if (nama_peminjamInput === '') {
                            alertDiv.innerHTML = '* Nama tidak boleh kosong';
                            return;
                        }
                        
                        // Check if nama contains only letters and spaces
                        if (!/^[a-zA-Z\s]+$/.test(nama_peminjamInput)) {
                            alertDiv.innerHTML = '* Nama harus berupa huruf dan spasi';
                            return;
                        }

                        // Check if NIM is not exactly 12 digits
                        if (nama_peminjamInput.length <= 3) {
                            alertDiv.innerHTML = '* Nama harus lebih dari 3 karakter.';
                            return;
                        }
                    });
                </script>
            </div>
        </div>


        <!-- kolom isian nim peminjam beserta allert js -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="nim_peminjam" class="col-md-4 col-form-label text-md-end">{{ __('NIM Peminjam') }}</label>

            <div class="col-md-4">
              <input id="nim_peminjam" type="text" class="form-control @error('nim_peminjam') is-invalid @enderror" name="nim_peminjam" value="{{ old('nim_peminjam') }}" required autocomplete="nim_peminjam" autofocus placeholder="Masukkan NIM Peminjam" style="font-size:14px;">

              <div id="nim_peminjam-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                <script>
                    document.getElementById('nim_peminjam').addEventListener('input', function () {
                        var nim_peminjamInput = this.value.trim();
                        var alertDiv = document.getElementById('nim_peminjam-alert');
                        
                        // Reset the alert
                        alertDiv.innerHTML = '';

                        // Check if NIM is empty
                        if (nim_peminjamInput === '') {
                            alertDiv.innerHTML = '* NIM tidak boleh kosong';
                            return;
                        }
                        
                        // Check if NIM is not numeric
                        if (!/^\d+$/.test(nim_peminjamInput)) {
                            alertDiv.innerHTML = '* NIM harus berupa angka';
                            return;
                        }

                        // Check if NIM is not exactly 12 digits
                        if (nim_peminjamInput.length !== 12) {
                            alertDiv.innerHTML = '* NIM harus terdiri dari 12 digit';
                            return;
                        }
                    });
                </script>
            </div>
        </div>


        <!-- kolom isian nomor telp beserta allert js -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="no_telp" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Telepon') }}</label>

            <div class="col-md-4">
              <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus placeholder="Masukkan Nomor Telepon" style="font-size:14px;">

              <div id="no_telp-alert" style="color: #FA1E0E; font-size: 12px; margin-top: 5px; font-weight: bold;"></div>

                <script>
                    document.getElementById('no_telp').addEventListener('input', function () {
                        var no_telpInput = this.value.trim();
                        var alertDiv = document.getElementById('no_telp-alert');
                        
                        // Reset the alert
                        alertDiv.innerHTML = '';

                        // Check if NIM is empty
                        if (no_telpInput === '') {
                            alertDiv.innerHTML = '* No Telp tidak boleh kosong';
                            return;
                        }
                        
                        // Check if NIM is not numeric
                        if (!/^\d+$/.test(no_telpInput)) {
                            alertDiv.innerHTML = '* No Telp harus berupa angka';
                            return;
                        }

                        // Check if NIM is not exactly 12 digits
                        if (no_telpInput.length < 9 || no_telpInput.length > 13) {
                            alertDiv.innerHTML = '* No Telp harus terdiri antara 9 - 13 digit';
                            return;
                        }
                    });
                </script>
            </div>
        </div>


        <!-- Dropdown Kelas -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="kelas" class="col-md-4 col-form-label text-md-end">{{ __('Kelas') }}</label>

          <div class="col-md-4">
              <select class="form-select" id="kelas" name="kelas" autocomplete="off">
                  <option disabled selected>Pilih Kelas</option>
                  @foreach($kelass as $kelas)
                  <option value="{{ $kelas }}">{{ $kelas }}</option>
                  @endforeach
              </select>

              <script>
                  document.getElementById('kelas').addEventListener('change', function () {
                      var kelasInput = this.value.trim();
                      var alertDiv = document.getElementById('kelas-alert');

                      // Reset pemberitahuan
                      alertDiv.innerHTML = '';

                      // Validasi kelas
                    if (kelasInput === '' || kelasInput === 'Pilih Kelas') {
                        alertDiv.innerHTML = '* Kelas harus dipilih';
                        return;
                    }
                  });
              </script>
          </div>
        </div>


        <!-- drop down program studi -->
        <div class="row mb-3" style="margin-left: 50px;">
          <label for="prodi" class="col-md-4 col-form-label text-md-end">{{ __('Program Studi') }}</label>

        <div class="col-md-4">
          <select class="form-select" id="prodi" name="prodi" autocomplete="off">
              <option disabled selected>Pilih Program Studi</option>
              @foreach($prodis as $prodi)
              <option value="{{ $prodi }}">{{ $prodi }}</option>
              @endforeach
          </select>

              <script>
                  document.getElementById('prodi').addEventListener('change', function () {
                      var prodiInput = this.value.trim();
                      var alertDiv = document.getElementById('prodi-alert');

                      // Reset pemberitahuan
                      alertDiv.innerHTML = '';

                      // Validasi kelas
                    if (prodiInput === '' || prodiInput === 'Pilih Program Studi') {
                        alertDiv.innerHTML = '* Program Studi harus dipilih';
                        return;
                    }
                  });
              </script>
        </div>
      </div>


        <!-- button -->
        <div class="row mb-0">
          <div class="col-md-6 offset-md-10">
            <button type="submit" class="btn btn-primary" onclick="validateAndSubmit()">
              {{ __('Kirim') }}
            </button>
            <button type="reset" class="btn btn-danger">
              {{ __('Batal') }}
            </button>        
          </div>
        </div>

      
        <!-- script allert masing masing kolom -->
        <script>
          function validateAndSubmit() {
              clearAllAlerts();

              var tanggalInput = document.getElementById('tanggal').value;
              var jam_peminjamanInput = document.getElementById('jam_peminjaman').value;
              var jam_pengembalianInput = document.getElementById('jam_pengembalian').value;
              var nama_dosenInput = document.getElementById('nama_dosen').value;
              var nama_matakuliahInput = document.getElementById('nama_matakuliah').value;
              var ruanganInput = document.getElementById('ruangan').value;
              var barang1Input = document.getElementById('barang1').value;
              var barang2Input = document.getElementById('barang2').value;
              var barang3Input = document.getElementById('barang3').value;
              var nama_peminjamInput = document.getElementById('nama_peminjam').value.trim();
              var nim_peminjamInput = document.getElementById('nim_peminjam').value.trim();
              var no_telpInput = document.getElementById('no_telp').value.trim();
              var kelasInput = document.getElementById('kelas').value;
              var prodiInput = document.getElementById('prodi').value;

                // Check if all validations pass
              if (
                  // Validasi tanggal
                  tanggalInput !== '' && tanggalInput !== 'Pilih Tanggal' &&
                  // Validasi jam peminjaman
                  jam_peminjamanInput !== '' && jam_peminjamanInput !== 'Pilih Jam Peminjaman' &&
                  // Validasi jam pengembalian
                  jam_pengembalianInput !== '' && jam_pengembalianInput !== 'Pilih Jam Pengembalian' &&
                  // Validasi dosen
                  nama_dosenInput !== '' && nama_dosenInput !== 'Pilih Dosen' &&
                  // Validasi matkul
                  nama_matakuliahInput !== '' && nama_matakuliahInput !== 'Pilih Mata Kuliah' &&
                  // Validasi ruangan
                  (barang1Input == '' ||
                  // Validasi ruangan
                  barang2Input == '' ||
                  // Validasi ruangan
                  barang3Input == '' ) &&
                  // Validasi nim
                  nim_peminjamInput !== '' &&
                  /^[0-9]+$/.test(nim_peminjamInput) &&
                  nim_peminjamInput.length === 12 &&
                  // Validasi nama
                  nama_peminjamInput !== '' &&
                  /^[a-zA-Z\s]+$/.test(nama_peminjamInput) &&
                  nama_peminjamInput.length >= 3 &&
                  // Validasi no_telp
                  no_telpInput !== '' &&
                  /^[0-9]+$/.test(no_telpInput) &&
                  (no_telpInput.length >= 9 && no_telpInput.length <= 13) &&
                  // Validasi kelas
                  kelasInput !== '' && kelasInput !== 'Pilih Kelas' &&
                  // Validasi prodi
                  prodiInput !== '' && prodiInput !== 'Pilih Program Studi'
              ) {
                  // If validations pass, submit the form
                  document.getElementById('peminjaman').submit();
              } else {
                  // If validations fail, display an alert
                  alert('Peminjaman gagal. Periksa kembali isian formulir Anda.');
              }

            }

            // Fungsi untuk membersihkan semua pemberitahuan
            function clearAllAlerts() {
                var alertDivs = document.querySelectorAll('[id$="-alert"]');
                alertDivs.forEach(function (alertDiv) {
                    alertDiv.innerHTML = '';
                });
            }
      </script>
      
  </body>
</html>