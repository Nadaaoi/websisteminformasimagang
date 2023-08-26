<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pemagangan;
use Illuminate\Support\Facades\Auth;

class PesertamagangController extends BaseController
{
    public function index()
    {
        $title = 'pesertamagang';
        $user_id = Auth::user()->id;

        $pesertamagang = Pemagangan::where('statuspengajuan', 'DITERIMA')->get();

        return view('pesertamagang.index', compact('title', 'pesertamagang'));
    }
}
