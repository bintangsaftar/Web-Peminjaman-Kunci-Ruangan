<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ubah Waktu</title>
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
        <div class="UbahWaktu" style="color: black; font-size: 25px; font-family: Roboto; font-weight: 700; word-wrap: break-word; padding-top: 50px">
            Ubah Waktu</div>
    </div>

    <div class="container">
        @foreach($waktuItems as $waktuItem)
        <form method="POST" action="{{ route('ubah-waktu', ['idwaktu' => $waktuItem->idwaktu]) }}">
            @csrf
            @method('PATCH')
            <label for="waktu" style="color: black; font-size: 20px; font-family: Roboto; font-weight: 400; padding-top: 10px;">Waktu</label>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="waktu" name="waktu" placeholder="Masukkan Waktu" autocomplete="off" value="{{ $waktuItem->waktu }}">
                </div>
            </div>
            <a href="/mengelola-waktu" style="text-decoration: none;">
                <button type="button" class="btn btn-danger" style="margin-top: 15px; font-weight: bold;">Kembali</button>
            </a>
            <button type="submit" class="btn btn-warning" style="margin-left: 10px; margin-top: 15px; font-weight: bold;">Ubah</button>
        </form>
        @endforeach
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