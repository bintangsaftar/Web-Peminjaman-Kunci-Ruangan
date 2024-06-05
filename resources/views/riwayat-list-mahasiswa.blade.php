<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Riwayat Peminjaman List</title>
        <meta charset="utf-8"> <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    </head>

    <body>
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
                        <a class="nav-link text-light" href="peminjaman" style="margin-left: 100px; font-family:roboto;">Peminjaman Ruangan & Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="riwayat-list-mahasiswa" style="margin-left: 100px; font-family:roboto;">Riwayat</a>
                    </li>
                </ul>
                <a href="#notifikasi">
                    <img src="{{ asset('img/notif.svg') }}" alt="Logo Notifikasi" style="height: 25px; margin-right: 30px;">
                </a>
            </div>
          </nav>

      <div class="container" style="margin-top: 20px;">
        <p class="h4">Riwayat Peminjaman - Tabel</p> </div>

<section>
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent" style="height:100px">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"
                        style="margin-left: 85px; font-family: roboto; font-size: 17px; font-weight: 600;">Tabel</a>
                    <div class="Rectangle6"
                        style="width: 250px; height: 5px; background: #3D9EDE; border-radius: 12px;">
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-gray" href="riwayat-diagram-mahasiswa"
                        style="margin-left: 85px; font-family:roboto; font-size: 17px; font-weight: 600;">Diagram</a>
                    <div class="Rectangle6" style="width: 250px; height: 5px; background: gray; border-radius: 12px;">
                    </div>
                </li>
            </ul>
        </div>
</section>

<div class="container">
    <form action="{{ route('filter_mahasiswa') }}" method="GET" onsubmit="return validateDate()">
        @csrf
        <div class="row align-items-end">
            <!-- Button Tanggal Mulai-->
            <div class="col-md-2">
                <label for="start_date">Mulai Tanggal:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" class="form-control">
            </div>

            <!-- Button Tanggal Akhir-->
            <div class="col-md-2">
                <label for="end_date">Sampai Tanggal:</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>

            <!-- Dropdown Ruangan -->
            <div class="col-md-2">
                <label for="room">Ruangan:</label>
                <select class="form-control" id="room" name="room">
                    <option value="">Pilih Ruangan</option>
                    @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan }}">{{ $ruangan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Button Cari -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary mt-2">Cari</button>
            </div>
        </div>
    </form>
</div>


<div class="container mt-4">
    <table class="table table-bordered mt-3 print-content" style="text-align:center; font-size: 14px;">
            <thead class="col bg-primary text-white" style="text-align:center; font-family:roboto;">
                <tr>
                <td>Tanggal</td>
                <td>Jam Peminjaman</td>
                <td>Jam Pengembalian</td>
                <td>Dosen</td>
                <td>Mata Kuliah</td>
                <td>Ruangan</td>
                <td>Barang 1</td>
                <td>Barang 2</td>
                <td>Barang 3</td>
                <td>Nama Peminjamn</td>
                <td>NIM Peminjam</td>
                <td>Nomor Telepon</td>
                <td>Kelas</td>
                <td>Program Studi</td>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $riwayat)
            <tr>
            <td>{{ $riwayat->tanggal }}</td>
            <td>{{ $riwayat->jam_peminjaman }}</td>
            <td>{{ $riwayat->jam_pengembalian }}</td>
            <td>{{ $riwayat->nama_dosen }}</td>
            <td>{{ $riwayat->nama_matakuliah }}</td>
            <td>{{ $riwayat->ruangan }}</td>
            <td>{{ $riwayat->barang1 }}</td>
            <td>{{ $riwayat->barang2 }}</td>
            <td>{{ $riwayat->barang3 }}</td>
            <td>{{ $riwayat->nama_peminjam }}</td>
            <td>{{ $riwayat->nim_peminjam }}</td>
            <td>{{ $riwayat->no_telp }}</td>
            <td>{{ $riwayat->kelas }}</td>
            <td>{{ $riwayat->prodi }}</td>
            </tr>
            @endforeach
            
            <!-- Script untuk Pop Up jika Memilih Tanggal Melebihi Tanggal Sekarang-->
            <script>
            function validateDate() {
                var startDate = document.getElementById('start_date').value;
                var today = new Date().toISOString().split('T')[0];
                
                if (startDate > today) {
                    alert('Data yang anda cari tidak tersedia.');
                    return false; // Memastikan form tidak di-submit
                }
                return true; // Submit form jika tanggal valid
            }
            </script>

            </tbody>
        </table>
    </div>

</body>
</html>