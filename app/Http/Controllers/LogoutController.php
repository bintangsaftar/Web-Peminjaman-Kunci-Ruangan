<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect('/login'); // Ganti dengan halaman yang sesuai setelah logout
    }
}