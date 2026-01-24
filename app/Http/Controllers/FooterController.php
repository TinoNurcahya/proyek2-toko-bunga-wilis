<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Menampilkan halaman FAQ
     */
    public function faq()
    {
        return view('user.footer.faq', [
            'theme'  => 'light',
        ]);
    }

    /**
     * Menampilkan halaman Cara Memesan
     */
    public function caraMemesan()
    {
        return view('user.footer.cara-memesan', [
            'theme'  => 'light',
        ]);
    }
}