<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\LaporanAkhir;
use App\Models\User;
use App\Models\Pemagangan;


class LaporanAkhirController extends Controller
{
    public function index()
    {
        $title = 'LaporanAkhir';
        $user = auth()->user(); // Get the logged-in user (assuming you are using Laravel Auth)
    
        // Get the count of laporan akhir submissions for the user
        $laporanAkhirCount = LaporanAkhir::where('user_id', $user->id)->count();
        $us = LaporanAkhir::where('user_id', $user->id)->get();
        $pemagangan = Pemagangan::where('user_id', $user->id)->get();
    
        // Check if user_id is 0 or the laporan akhir count is 0, then redirect to the index page
        if ($user->id === 0 || $laporanAkhirCount === 0) {
            return view('User.LaporanAkhir.index', compact('title','us', 'user', 'pemagangan'));
        } else {
            return view('User.LaporanAkhir.show', compact('title', 'us', 'user', 'pemagangan'));
        }
    }
    

    public function store(Request $request)
    {
    
        // return ddd();
        $message = [
            'mimes' => 'File Harus Berbentuk PDF',
            'max' => 'Maksimal ukuran file 5 MB',
            'required' => 'Wajib Diisi',
        ];

        $request->validate([
            'laporanakhir' => 'mimes:pdf|file|max:2048',
            'sertifikat' => 'mimes:pdf|file|max:2048',
            'nilai' => 'mimes:pdf|file|max:2048',
        ],$message);

        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Auth::user()->slug;
        $data['nama'] = ucwords($request->nama);

        $nama_path = Str::slug(Auth::user()->name . date('d,h,i,s'));

        if($request->file('laporanakhir')){
            $data['laporanakhir'] = $request->file('laporanakhir')->storeAs('public/laporanakhir', $nama_path . '-laporanakhir');
        }
        if($request->file('sertifikat')){
            $data['sertifikat'] = $request->file('sertifikat')->storeAs('public/sertifikat', $nama_path . '-sertifikat');
        }
        if($request->file('nilai')){
            $data['nilai'] = $request->file('nilai')->storeAs('public/nilai', $nama_path . '-nilai');
        }
        
        
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug(Auth::user()->name .'-' . date('d,h,i,s'));
        // dd($data);
        LaporanAkhir::create($data);
        return redirect()->route('laporanakhir.index')->with('success', 'Laporan kamu berhasil disimpan!');
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
