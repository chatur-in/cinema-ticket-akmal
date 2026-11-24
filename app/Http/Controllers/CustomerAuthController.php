<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    /*
    | HALAMAN LOGIN CUSTOMER
    */

    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {

            // Admin yang sedang login tidak boleh membuka form login customer.
            if (Auth::user()->role === 'admin') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'info',
                        'Anda sedang login sebagai administrator. Logout terlebih dahulu untuk masuk sebagai customer.'
                    );
            }

            return redirect()->route('customer.dashboard');
        }

        return view('customer.auth.login');
    }


    /*
    | PROSES LOGIN CUSTOMER
    */

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'customer',
        ];

        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            return back()
                ->withErrors([
                    'email' =>
                        'Email atau password salah. Pastikan menggunakan akun customer.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectAfterAuthentication($request);
    }


    /*
    | HALAMAN REGISTRASI CUSTOMER
    */

    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {

            if (Auth::user()->role === 'admin') {
                return redirect()
                    ->route('admin.dashboard')
                    ->with(
                        'info',
                        'Anda sedang login sebagai administrator. Logout terlebih dahulu untuk mendaftar akun customer.'
                    );
            }

            return redirect()->route('customer.dashboard');
        }

        return view('customer.auth.register');
    }


    /*
    | PROSES REGISTRASI CUSTOMER
    */

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        // Role selalu ditentukan oleh server.
        // Pengguna tidak dapat mendaftar sebagai admin.
        $user = User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => $validated['password'],
            'role' => 'customer',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return $this->redirectAfterAuthentication($request);
    }


    /*
    | REDIRECT SETELAH LOGIN / REGISTRASI
    |
    | Jika sebelumnya pengunjung memilih jadwal,
    | lanjutkan langsung ke pemilihan kursi.
    |
    | Jika tidak ada jadwal sementara,
    | arahkan ke dashboard customer.
    */

    private function redirectAfterAuthentication(
        Request $request
    ): RedirectResponse {

        $pendingJadwalId = $request->session()->pull(
            'booking.pending_jadwal_id'
        );

        if ($pendingJadwalId) {

            $request->session()->put([
                'booking.jadwal_id' => $pendingJadwalId,
                'booking.selected_seats' => [],
            ]);

            return redirect()
                ->route('booking.seats')
                ->with(
                    'success',
                    'Login berhasil. Silakan pilih kursi untuk melanjutkan pemesanan.'
                );
        }

        return redirect()
            ->route('customer.dashboard')
            ->with(
                'success',
                'Selamat datang di CinemaTicket!'
            );
    }


    /*
    | LOGOUT CUSTOMER
    */

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'Kamu berhasil logout.');
    }
}