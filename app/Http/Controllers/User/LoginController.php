<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // Menampilkan Halaman Login
    public function login()
    {
        return view('auth.user.login');
    }

    // Menampilkan Halaman OAuth Google
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    // Melakukan Proses Register
    public function handleGoogleProviderCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();

        // Parsing data
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
        ];

        // Create data user
        // firstOrCreate: jika bertemu email yang sama tidak perlu menambahkan data baru, jika tidak ketemu akan ditambahkan data baru
        $user = User::firstOrCreate(
            ['email' => $data['email']], $data
        );

        // Khusus login
        Auth::login($user, true);

        // Setelah berhasil login diarahkan kehalaman utama sistem
        return redirect()->route('home');
    }
}
