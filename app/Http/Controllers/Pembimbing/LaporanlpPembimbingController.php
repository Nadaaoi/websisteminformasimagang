<?php

namespace App\Http\Controllers\Pembimbing;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pemagangan;
use App\Models\LaporanAkhir;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;


class laporanLpPembimbingController extends BaseController
{
    // public function index()
    // {   
    //     $title = 'laporanlppembimbing';
    //     $user_id = Auth::user()->id;
    
    //     // $pemagangan = Pemagangan::get();
    //     // $laporanlp = LaporanAkhir::where('user_id', $user_id)->get();
    //     // $pemagangan = Pemagangan::with('laporanAkhir')->get();
    //     $pemagangan = Pemagangan::all();
    //     $laporanlp = LaporanAkhir::all();
    //     $laporanlpcount = LaporanAkhir::where('user_id', $user_id)->count();

    //     // dd($laporanlpcount);
    //     return view('pembimbing.laporanlp.index', compact('title', 'pemagangan', 'laporanlp','laporanlpcount'));
    // }

    public function index()
    {   
        $title = 'laporanlp';
        $user_id = Auth::user()->id;
    
        $logged_in_user_id = Auth::user()->id;
        $pemagangan = Pemagangan::where('statuspengajuan', 'DITERIMA')
            ->where('id_pembimbing', $logged_in_user_id)
            ->get();        

        // Get all laporan akhir
        $laporanlp = LaporanAkhir::all();

        // Get the count of laporan akhir for the logged-in user
        $laporanlpcount = LaporanAkhir::where('user_id', $user_id)->count();


        // dd($laporanlpcount);
        return view('Pembimbing.laporanlp.index', compact('title', 'pemagangan', 'laporanlp','laporanlpcount'));
    }

    public function view_laporanakhir($id)
    {
        if(Auth::user()->id != $id){
            return redirect()->back();
        }
            
        $path = LaporanAkhir::where('id', $id)->first();
        $outputfile = url('storage/'.$path->laporanakhir);
    
        return response()->file($outputfile);
    }
    
    
    public function view_sertifikat($id)
    {
    
            $path = LaporanAkhir::where('id', $id)->get();
            $outputfile = public_path('storage/'.$path[0]->sertifikat);
    
            return response()->file($outputfile);
    }
    
    public function view_nilai($id)
    {
            // if(Auth::user()->id != $id){
            //     return redirect()->back();
            // }
    
            $path = LaporanAkhir::where('id', $id)->get();
            $outputfile = public_path('storage/'.$path[0]->nilai);
          
            return response()->file($outputfile);
    }
}
