<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tambah Mata Kuliah</title>
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
        <div class="TambahMatkul" style="color: black; font-size: 25px; font-family: Roboto; font-weight: 700; word-wrap: break-word; padding-top: 50px">
            Tambah Mata Kuliah</div>
    </div>

    <div class="container">
        <form method="POST" action="/tambah-matkul">
            @csrf
            <label for="kode_matkul" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Kode Mata Kuliah</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="kode_matkul" name="kode_matkul" placeholder="Masukkan Kode Mata Kuliah" autocomplete="off">
                </div>
            </div>
            <label for="matkul" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Mata Kuliah</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="matkul" name="matkul" placeholder="Masukkan Mata Kuliah" autocomplete="off">
                </div>
            </div>
            <label for="sks" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">SKS</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="sks" name="sks" placeholder="Masukkan SKS" autocomplete="off">
                </div>
            </div>
            <a href="/mengelola-matkul" style="text-decoration: none;">
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