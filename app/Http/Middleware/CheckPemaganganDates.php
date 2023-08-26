<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Pemagangan;

class CheckPemaganganDates
{
    public function handle($request, Closure $next)
    {
        $user_id = auth()->user()->id;
        $pemagangan = Pemagangan::where('user_id', $user_id)->first();

        if ($pemagangan) {
            $tanggalmulai = Carbon::parse($pemagangan->tanggalmulai)->setTimezone('Asia/Jakarta');
            $tanggalselesai = Carbon::parse($pemagangan->tanggalselesai)->setTimezone('Asia/Jakarta');
            $now = Carbon::now('Asia/Jakarta');
        
            // Tambahkan 1 minggu (7 hari) ke tanggal selesai pemagangan
            $tanggalselesai->addWeek();
        
            if ($now >= $tanggalmulai && $now <= $tanggalselesai) {
                return $next($request);
            }
        }
        
        // Jika tanggal saat ini tidak berada di rentang tanggalmulai dan tanggalselesai,
        // maka redirect ke halaman lain atau berikan pesan error.
        return redirect()->route('dashboard')->with('error', 'Anda tidak dapat mengakses halaman logbook saat ini. Karena diluar jadwal pemagangan!');
        
    }
}
