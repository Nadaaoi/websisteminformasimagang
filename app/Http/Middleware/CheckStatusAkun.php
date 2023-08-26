<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckStatusAkun
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil status_akun dari user saat ini
        $status_akun = auth()->user()->status_akun;

        // Lakukan pengecekan status_akun
        if ($status_akun === 'DITERIMA') {
            // Jika status_akun 'diterima', lanjutkan dengan request
            return $next($request);
        } else {
            // Jika status_akun 'terdaftar' atau 'ditolak', redirect atau berikan respon sesuai kebutuhan
            return redirect()->route('pemagangan.index')->with('warning', 'Lakukan pendaftaran terlebih dahulu!'); // Ganti 'halaman_lain' dengan nama route halaman lain yang ingin ditampilkan jika akses ditolak.
        }
    }
}
