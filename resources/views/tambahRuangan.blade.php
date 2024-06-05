<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Ruangan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body>

    @include('includes.nav-mengelola-selected')

    @if ($errors->any())
    <div id="errorMessage" class="alert alert-danger bg-danger" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; padding: 20px; color: white; border-radius: 10px; z-index: 10;">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif

    <div class="container">
        <div class="TambahRuangan" style="color: black; font-size: 25px; font-family: Roboto; font-weight: 700; word-wrap: break-word; padding-top: 50px">
            Tambah Ruangan</div>
    </div>

    <div class="container">
        <form method="POST" action="/tambah-ruangan">
            @csrf
            <label for="kode_ruangan" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Kode Ruangan</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="kode_ruangan" name="kode_ruangan" placeholder="Masukkan Kode Ruangan" autocomplete="off">
                </div>
            </div>
            <label for="nama_ruangan" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Nama Ruangan</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" placeholder="Masukkan Nama Ruangan" autocomplete="off">
                </div>
            </div>
            <div class="col-md-4">
                <label for="luas_ruangan" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Luas Ruangan</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="luas_ruangan" name="luas_ruangan" placeholder="Masukkan Luas Ruangan" autocomplete="off">
                    <div class="input-group-append" style="z-index: 7;">
                        <span class="input-group-text" id="m2Label">m²</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="status_ruangan" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Status Ruangan</label>
                <select class="form-select" id="status_ruangan" name="status_ruangan" autocomplete="off">
                    <option disabled selected>Pilih Status Ruangan</option>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <a href="/mengelola-ruangan" style="text-decoration: none;">
                <button type="button" class="btn btn-danger" style="margin-top: 15px; font-weight: bold;">Kembali</button>
            </a>
            <button type="submit" class="btn btn-primary" style="margin-left: 10px; margin-top: 15px; font-weight: bold;">Tambah</button>
        </form>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const errorMessage = document.getElementById('errorMessage');
            if (errorMessage) {
                errorMessage.style.display = 'block';
                setTimeout(function() {
                    errorMessage.style.display = 'none';
                }, 3000); // Menghilangkan pesan error setelah 3 detik
            }
        });

        document.getElementById('luas_ruangan').addEventListener('input', function() {
            var luasRuanganInput = document.getElementById('luas_ruangan');
            var m2Label = document.getElementById('m2Label');
            m2Label.innerHTML = luasRuanganInput.value + ' m²';
        });
    </script>


</body>

</html>