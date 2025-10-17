<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class GoogleController extends Controller
{
  public function redirect()
  {
    return Socialite::driver('google')->redirect();
  }

  public function callback()
  {
    $googleUser = Socialite::driver('google')->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
      $user = User::create([
        'nama' => $googleUser->getName(),
        'email' => $googleUser->getEmail(),
        'password' => Str::random(16),
      ]);
    }
    Auth::login($user);

    return redirect()->route('dashboard');
  }
}
