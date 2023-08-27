<?php

namespace App\Http\Controllers;

use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PesertamagangController extends BaseController
{
    public function index(Request $request)
    {
        $title = 'pesertamagang';
        $user_id = Auth::user()->id;
        $selectedYear = $request->input('year', date('Y')); // Ambil tahun dari request atau gunakan tahun saat ini
        $pesertamagang = Pemagangan::where('statuspengajuan', 'DITERIMA')
            ->whereYear('created_at', $selectedYear)
            ->get();

        return view('pesertamagang.index', compact('title', 'pesertamagang', 'selectedYear'));
    }

}
