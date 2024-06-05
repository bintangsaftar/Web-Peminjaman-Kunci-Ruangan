<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ditolak;

class DitolakController extends Controller
{
    public function index()
    {
        $data = Ditolak::all();
        return view('ditolak', ['data' => $data]);
        return view('ditolak', ['data' => $data]);

    }
}