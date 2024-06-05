<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pengembalian</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<form method="POST" action="/pengembalian">
  @csrf

  <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:100px;">
      <div class="container-fluid" style="margin-right: 50px;">
          <a href="#beranda">
              <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" style="height: 50px; margin-left: 50px;">
          </a>
          <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                  <a class="nav-link text-light" href="#" style="font-family:roboto;">Info Ruangan</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-dark" href="#" style="margin-left: 100px; font-family:roboto;">Peminjaman & Pengembalian</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-light" href="#" style="margin-left: 100px; font-family:roboto;">Riwayat</a>
              </li>
          </ul>
          <a href="#notifikasi">
              <img src="{{ asset('img/notif.svg') }}" alt="Logo Notifikasi" style="height: 25px; margin-right: 30px;">
          </a>
          <a href="#panahbawah">
              <img src="{{ asset('img/ion_chevron-back.svg') }}" alt="Logo Panah Bawah" style="height: 25px;">
          </a>
      </div>
    </nav>

  <section>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent" style="height:130px">
      <div class="container-fluid">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link text-gray" href="/peminjaman"
              style="margin-left: 70px; font-family: roboto; font-size: 17px; font-weight: 600;">Peminjaman</a>
            <div class="Rectangle6" style="width: 250px; height: 5px; background: gray; border-radius: 12px;"></div>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light" href="/pengembalian"
              style="margin-left: 70px; font-family:roboto; font-size: 17px; font-weight: 600;">Pengembalian</a>
            <div class="Rectangle6" style="width: 250px; height: 5px; background: #3D9EDE; border-radius: 12px;"></div>
          </li>
        </ul>
      </div>
  </section>

<div class="row mb-3">
  <div class="col-md-6 col-form-label text-md-end" style="color: black; font-size: 25px; font-family: Roboto; font-weight: 700; padding-top: 1px; margin-left: 95px">
    Form Pengembalian Ruangan & Barang</div>
</div>

 
      <div class="row mb-3">
      <label for="matakuliah" class="col-md-5 col-form-label text-md-end">{{ __('Foto Ruangan (Tampak Awal)') }}</label>
                <div class="col-md-4">
                    <input class="form-control" type="file" id="formFile" onchange="preview()">
                </div>
                <img id="frame" src="" class="img-fluid" />
            </div>

            <div class="row mb-3">
      <label for="matakuliah" class="col-md-5 col-form-label text-md-end">{{ __('Foto Ruangan (Tampak Akhir)') }}</label>
                <div class="col-md-4">
                    <input class="form-control" type="file" id="formFile" onchange="preview()">
                </div>
                <img id="frame" src="" class="img-fluid" />
            </div>

            <div class="row mb-3">
      <label for="matakuliah" class="col-md-5 col-form-label text-md-end">{{ __('Foto Barang (Tampak Awal)') }}</label>
                <div class="col-md-4">
                    <input class="form-control" type="file" id="formFile" onchange="preview()">
                </div>
                <img id="frame" src="" class="img-fluid" />
            </div>

            <div class="row mb-3">
      <label for="matakuliah" class="col-md-5 col-form-label text-md-end">{{ __('Foto Barang (Tampak Akhir)') }}</label>
                <div class="col-md-4">
                    <input class="form-control" type="file" id="formFile" onchange="preview()">
                </div>
                <img id="frame" src="" class="img-fluid" />
            </div>

      <div class="row mb-0">
        <div class="col-md-6 offset-md-10">
          <button type="submit" class="btn btn-primary">
            {{ __('Kirim') }}
          </button>
          <button type="refresh" class="btn btn-danger">
            {{ __('Batal') }}
          </button>
        </div>
      </div>

  </body>
</html>