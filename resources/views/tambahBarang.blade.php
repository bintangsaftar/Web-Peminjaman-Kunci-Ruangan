<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Barang</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<body>

    @include('includes.nav-mengelola-selected')

    @if ($errors->any())
    <div id="errorMessage" class="alert alert-danger bg-danger" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 24px; padding: 20px; color: white; border-radius: 10px;">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif


    <div class="container">
        <div class="TambahBarang" style="color: black; font-size: 25px; font-family: Roboto; font-weight: 700; word-wrap: break-word; padding-top: 50px">
            Tambah Barang</div>
    </div>

    <div class="container">
        <form method="POST" action="/tambah-barang">
            @csrf
            <label for="kode_barang" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Kode Barang</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Masukkan Kode Barang" autocomplete="off">
                </div>
            </div>
            <label for="nama_barang" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Nama Barang</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang" autocomplete="off">
                </div>
            </div>
            <label for="deskripsi_barang" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Deskripsi Barang</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" placeholder="Masukkan Deskripsi Barang" rows="4" autocomplete="off"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="status_barang" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Status Barang</label>
                    <select class="form-select" id="status_barang" name="status_barang" autocomplete="off">
                        <option disabled selected>Pilih Status Barang</option>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="merek_barang" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Merek Barang</label>
                    <input type="text" class="form-control" id="merek_barang" name="merek_barang" placeholder="Masukkan Merek Barang" autocomplete="off">
                </div>
            </div>
            <a href="/mengelola-barang" style="text-decoration: none;">
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
    </script>


</body>

</html>