<?php

namespace App\Http\Controllers\Pembimbing;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pemagangan;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogbookExport;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\File;
use PDF;
use TCPDF;


class LaporanLogbookPembimbingController extends BaseController
{
    public function index()
{
    $title = 'laporanlogbookpembimbing';
    $user_id = Auth::user()->id;

    // Ambil data pemagangan berdasarkan id_pembimbing yang sama dengan user_id yang sedang login
    $pemagangan = Pemagangan::where('id_pembimbing', $user_id)->get();

    return view('pembimbing.laporanlogbook.index', compact('title', 'pemagangan'));
}


    public function show($user_id)
    {
        // $user_id = Auth::user()->id;
        $logbook = Logbook::where('user_id', $user_id)->get();
    
        $title = 'laporanlogbookpembimbing';
        // dd($title);
        return view('pembimbing.laporanlogbook.show', compact('logbook','title'));
    }
}
