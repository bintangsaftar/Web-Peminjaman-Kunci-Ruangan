<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    

    public function login(Request $request)
    {
        $nama_adminOrNim = $request->input('nama_admin_or_nim'); // Ganti 'email_or_nim' sesuai dengan field form yang digunakan untuk input
        $password = $request->input('password');

        $credentialsMahasiswa = [
            'nim' => $nama_adminOrNim,
            'password' => $password,
        ];

        $credentialsAdmin = [
            'nama_admin' => $nama_adminOrNim,
            'password' => $password,
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nama_admin_or_nim' => $nama_adminOrNim,'password' => $password),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Cookie: laravel_session=MMyuXAMDAE41rJ8VzitRZ3wZ9BFpx9Un3GmGUNKL'
        ),
        ));

        $response = curl_exec($curl);
        $responseData = json_decode($response, true);
        //print_r($responseData);
        curl_close($curl);
        //echo $response;


        // Attempt login UserMahasiswa
        if (Auth::guard('mahasiswa')->attempt($credentialsMahasiswa)) {
            $request->session()->regenerate();
            return redirect()->route('inforuangan-mahasiswa.index'); // Ganti 'peminjaman' sesuai dengan nama route untuk tampilan peminjaman
        }

        // Attempt login UserAdmin
        if (Auth::guard('admin')->attempt($credentialsAdmin)) {
            $request->session()->regenerate();
            return redirect()->route('inforuangan-admin.index_admin');
        }

        //throw ValidationException::withMessages(['nama_admin_or_nim' => 'NIM, Nama Admin, atau Password Salah'], 401);

        // Login gagal, dapatkan pesan kesalahan dari API atau gunakan pesan default
        throw ValidationException::withMessages(['nama_admin_or_nim' => 'Username atau Password Salah'])
            ->status(401); // Status HTTP 401 untuk menunjukkan unauthorized


        
    }
}

