<!DOCTYPE html>
<html lang="en">

<head>
  <title>Info Ruangan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:100px;">
    <div class="container-fluid" style="margin-right: 50px;">
      <a href="inforuangan-admin">
        <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" style="height: 50px; margin-left: 50px;">
      </a>
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link text-dark" href="inforuangan-admin" style="font-family:roboto">Info Ruangan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="persetujuan" style="margin-left: 200px; font-family:roboto;">Persetujuan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="/mengelola-ruangan" style="margin-left: 200px; font-family:roboto;">Mengelola</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="riwayat-list-admin" style="margin-left: 200px; font-family:roboto;">Riwayat</a>
        </li>
      </ul>
      <a href="#notifikasi">
        <img src="{{ asset('img/notif.svg') }}" alt="Logo Notifikasi" style="height: 25px; margin-right: 30px;">
      </a>
      <div>
        <form action="logout" method="POST">
            @csrf 
            <button type="submit">Logout</button>
        </form>
    </div>
    </div>
  </nav>

  <div class="container" style="margin-top: 20px; margin-bottom: 10px;">
    <label class="h4">Info Ruangan</label>
  </div>


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notifikasi Peminjaman Ruangan</title>
  <style>
    /* CSS untuk tampilan card notifikasi */
    .notification-card {
      position: fixed;
      top: 20px;
      right: 20px;
      width: 300px;
      background-color: #ffffff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
      padding: 20px;
      display: none;
      z-index: 999;
      /* Tingkat lapisan yang tinggi untuk memastikan di atas elemen lain */
    }
  </style>
  </head>

  <body>

    <!-- Card Notifikasi -->
    <div class="notification-card" id="notificationCard">
      <h3>Peminjaman Ruangan Disetujui</h3>
      <p>Anda berhasil meminjam ruangan. Silakan cek jadwal peminjaman Anda.</p>
      <button onclick="hideNotification()">Tutup</button>
    </div>

    <script>
      function showNotification() {
        var notificationCard = document.getElementById('notificationCard');
        notificationCard.style.display = 'block';
      }

      function hideNotification() {
        var notificationCard = document.getElementById('notificationCard');
        notificationCard.style.display = 'none';
      }
    </script>


    <!-- Hari -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Hari Ini</title>
      <style>
        h3 {
          text-align: center;
          font-size: 36px;
          color: #333;
        }

        p {
          text-align: center;
          font-size: 18px;
          color: #555;
        }
      </style>
    </head>

    <body>
      <h3 id="hariIni"></h3>
      <p id="tanggal"></p>

      <script>
        // Daftar nama hari 
        const namaHari = ["MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU"];

        // Fungsi untuk mendapatkan nama hari saat ini
        function getHariIni() {
          const hariSekarang = new Date().getDay();
          return namaHari[hariSekarang];
        }

        // Fungsi untuk mendapatkan tanggal saat ini
        function getTanggal() {
          const today = new Date();
          const day = today.getDate();
          const month = today.getMonth() + 1; // Months are zero-based
          const year = today.getFullYear();

          // Format the date as "DD/MM/YYYY"
          const formattedDate = `${day}/${month}/${year}`;
          return formattedDate;
        }

        // Fungsi untuk mengganti teks di dalam elemen h3 dengan nama hari saat ini
        function updateHari() {
          const h3 = document.getElementById("hariIni");
          h3.textContent = getHariIni();
        }

        // Fungsi untuk mengganti teks di dalam elemen p dengan tanggal saat ini
        function updateTanggal() {
          const tanggalElement = document.getElementById("tanggal");
          tanggalElement.textContent = getTanggal();
        }

        // Panggil fungsi updateHari dan updateTanggal untuk menampilkan nama hari dan tanggal saat ini
        updateHari();
        updateTanggal();
      </script>
    </body>

    </html>


    <!-- Jadwal -->
    <!-- <div class="card-container" style=" margin: 40px; justify-content: center; display: flex; flex-wrap: wrap; gap: 20px;">
  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header"style="background-color: #FFE600;">
      LAB PROGRAM 1
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">2B TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1A BSD | 09.10 - 10.50</li>
      <li class="list-group-item">3B TRPL | 12.30 - 14.10</li>
      <li class="list-group-item">1A BSD | 14.10 - 15.50</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB PROGRAM 2
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">2F TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1A TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header"style="background-color: #FFE600;">
      BASDAT
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">2A TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">3F TRK | 09.10 - 10.50</li>
      <li class="list-group-item">1A TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header"style="background-color: #FFE600;">
      LAB TUK
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">1B TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1C TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB DESAIN
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">2C TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1D TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header"style="background-color: #FFE600;">
      LAB MULTIMEDIA
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">1A TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">3G TRK | 09.10 - 10.50</li>
      <li class="list-group-item">2C TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB NIRKABEL
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">1F TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">2G TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB HARDWARE
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">2E TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1G TRPL | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB CLOUD COMPUTING
    </div>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">2F TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">1A BSD | 12.30 - 16.30</li>
    </ul>
  </div>

  <div class="card" style="text-align: center; width: 13rem;">
    <div class="card-header" style="background-color: #FFE600;">
      LAB CO WORKING
    </div>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">1F TRPL | 07.30 - 09.10</li>
      <li class="list-group-item">2D BSD | 09.10 - 10.50</li>
      <li class="list-group-item">3B TRPL | 12.30 - 14.10</li>
      <li class="list-group-item">1F BSD | 14.10 - 15.50</li>
    </ul>
  </div>
</div> -->



    <!-- Informasi Ruangan -->
    <div class="container mt-3">
      <table class="table table-bordered" style="text-align:center;">
        <thead class="col bg-primary text-white" style="text-align:center;">
          <tr>
            <td>Nama Ruangan</td>
            <td>Tanggal</td>
            <td>Waktu Peminjaman</td>
            <td>Waktu Pengembalian</td>
            <td>Nama Peminjam</td>
            <td>Program Studi</td>
            <td>Kelas</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $room)
          @php
          $roomIsUsed = false;
          $usedStatus = 'Tersedia'; // Default status
          $tanggal = '';
          $jamPeminjaman = '';
          $jamPengembalian = '';
          $namaPeminjam = '';
          $prodi = '';
          $kelas = '';
          @endphp
          @foreach ($datainfo as $info)
          @if ($info->ruangan === $room->nama_ruangan)
          @php
          $roomIsUsed = true;
          $usedStatus = 'Terpakai';
          $tanggal = $info->tanggal;
          $jamPeminjaman = $info->jam_peminjaman;
          $jamPengembalian = $info->jam_pengembalian;
          $namaPeminjam = $info->nama_peminjam;
          $prodi = $info->prodi;
          $kelas = $info->kelas;
          @endphp
          @endif
          @endforeach
          <tr>
            <td>{{ $room->nama_ruangan }}</td>
            <td>{{ $tanggal }}</td>
            <td>{{ $jamPeminjaman }}</td>
            <td>{{ $jamPengembalian }}</td>
            <td>{{ $namaPeminjam }}</td>
            <td>{{ $prodi }}</td>
            <td>{{ $kelas }}</td>
            <td>{{ $usedStatus }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>