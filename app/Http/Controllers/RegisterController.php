<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Admin;


class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $nim = $request->input('nim');
        $nama_mahasiswa = $request->input('nama_mahasiswa');
        $password = $request->input('password');

    


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://localhost:8000/api/register_mahasiswa',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('nim' => $nim,'nama_mahasiswa' => $nama_mahasiswa,'password' => $password),
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json'
        ),
        ));

        $response = curl_exec($curl);
        $responseData = json_decode($response, true);
        //print_r($responseData);
        curl_close($curl);
        //echo $response;

        return redirect()->route('login');



    /* public function register_admin(Request $request)
    {
        $validateData = $request->validate([
            'nama_admin' => 'required|string',
            'email' => 'required|email|unique:user_mahasiswa',
            'password' => 'required|confirmed',
            
        ]);

        $admin = new Admin([
            'nama_admin' => $request->nama_admin,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            
        ]);
        $admin->save();
        return response()->json($admin, 201);
    } */

}
}