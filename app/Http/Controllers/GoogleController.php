<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru tanpa sekolah_id dulu
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(str()->random(16)), // password random
                    'sekolah_id' => null,
                    'kode_unik' => null,
                    'role' => 'siswa',
                ]);
            }

            // Kalau user belum punya kode_unik/sekolah_id → redirect ke form input kode unik
            if (empty($user->kode_unik) || empty($user->sekolah_id)) {
                session(['google_user' => $googleUser]);
                return redirect()->route('kodeunik');
            }

            // Kalau sudah punya kode unik → langsung login
            Auth::login($user);
            return redirect('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Google gagal.');
        }
    }

}
