<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home');
    }

    public function kontak()
    {
        return view('home.kontak');
    }

    public function tentang()
    {
        return view('home.tentang');
    }

    public function visimisi()
    {
        return view('home.visimisi');
    }

    public function struktur()
    {
        return view('home.struktur');
    }
}
