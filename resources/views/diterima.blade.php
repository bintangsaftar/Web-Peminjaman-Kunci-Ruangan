<!DOCTYPE html>
<html lang="en">

<head>
    <title>Peminjaman Diterima</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height:100px;">
        <div class="container-fluid" style="margin-right: 50px;">
            <a href="inforuangan-admin">
                <img src="{{ asset('img/logo-poliwangi.png') }}" alt="Logo Poliwangi" style="height: 50px; margin-left: 50px;">
            </a>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-light" href="inforuangan-admin" style="font-family:roboto">Info Ruangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="persetujuan" style="margin-left: 200px; font-family:roboto;">Persetujuan</a>
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
        </div>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <p class="h4">Persetujuan Peminjaman Ruangan & Barang</p>
    </div>

    <section>
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent" style="height:130px">
            <div class="container-fluid">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link text-gray" href="persetujuan" style="margin-left: 20px; font-family: roboto; font-size: 17px; font-weight: 600;">Persetujuan Peminjaman</a>
                        <div class="Rectangle6" style="width: 250px; height: 5px; background: gray; border-radius: 12px;">
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-light" href="diterima" style="margin-left: 30px; font-family:roboto; font-size: 17px; font-weight: 600;">Peminjaman Diterima</a>
                        <div class="Rectangle6" style="width: 250px; height: 5px; background: #3D9EDE; border-radius: 12px;">
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-gray" href="ditolak" style="margin-left: 30px; font-family:roboto; font-size: 17px; font-weight: 600;">Peminjaman Ditolak</a>
                        <div class="Rectangle6" style="width: 250px; height: 5px; background: gray; border-radius: 12px;">
                        </div>
                    </li>
                </ul>
            </div>
    </section>

    <div class="container mt-3" style="margin-top: 80px">
        <table class="table table-bordered" style="text-align:center;  font-size:14px;">
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
                    <td>Penyelesaian</td>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $diterima)
                <tr id="diterima_{{ $diterima->id }}">
                    <td>{{ $diterima->tanggal }}</td>
                    <td>{{ $diterima->jam_peminjaman }}</td>
                    <td>{{ $diterima->jam_pengembalian }}</td>
                    <td>{{ $diterima->nama_dosen }}</td>
                    <td>{{ $diterima->nama_matakuliah }}</td>
                    <td>{{ $diterima->ruangan }}</td>
                    <td>{{ $diterima->barang1 }}</td>
                    <td>{{ $diterima->barang2 }}</td>
                    <td>{{ $diterima->barang3 }}</td>
                    <td>{{ $diterima->nama_peminjam }}</td>
                    <td>{{ $diterima->nim_peminjam }}</td>
                    <td>{{ $diterima->no_telp }}</td>
                    <td>{{ $diterima->kelas }}</td>
                    <td>{{ $diterima->prodi }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center">
                            <button onclick="selesaiPeminjaman({{ $diterima->id }}, 'riwayat')" class="btn btn-success">Selesai</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <script>
                function selesaiPeminjaman(id, status) {
                    $.ajax({
                        url: '/diterima/' + status + '/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#diterima_' + id).remove();
                            alert(response.message);
                        }
                    });
                }
            </script>
        </table>
    </div>
</body>

</html>