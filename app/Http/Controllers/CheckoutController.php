<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Cek session items
        $checkoutItems = Session::get('checkout_items', []);

        if (empty($checkoutItems)) {
            return redirect()->route('profile.keranjang')
                ->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        return view('profile.checkout', [
            'user' => $request->user(),
            'theme' => 'light'
        ]);
    }

    // Method untuk clear session
    public function clearSession()
    {
        Session::forget('checkout_items');
        Session::forget('checkout_info');

        return redirect()->route('keranjang')
            ->with('success', 'Session checkout telah dibersihkan');
    }
}
