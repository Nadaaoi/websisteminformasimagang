<?php

namespace App\Http\Controllers\Pembimbing;

use App\Exports\BimbinganExport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pemagangan;
use App\Models\Bimbingan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LaporanBimbinganPembimbingController extends BaseController
{
    public function index()
    {
        $title = 'laporanbimbinganpembimbing';
        $user_id = Auth::user()->id;
    
        // Ambil data pemagangan berdasarkan id_pembimbing yang sama dengan user_id yang sedang login
        $pemagangan = Pemagangan::where('id_pembimbing', $user_id)->get();
    
        return view('pembimbing.laporanbimbingan.index', compact('title', 'pemagangan'));
    }

    public function show($user_id)
    {
        // $user_id = Auth::user()->id;
        $laporanbimbingan = Bimbingan::where('user_id', $user_id)->get();
    
        $title = 'laporanbimbinganpembimbing';
        // dd($title);
        return view('pembimbing.laporanbimbingan.show', compact('laporanbimbingan','title'));
    }

    public function simpanKonfirmasi(Request $request)
    {
        $tandatanganpembimbing = $request->input('tandatanganpembimbing');

        // Lakukan validasi data jika diperlukan

        // Tangkap id bimbingan dari input hidden di form modal
        $bimbinganId = $request->input('bimbingan_id');

        // Cari data bimbingan berdasarkan id
        $bimbingan = Bimbingan::find($bimbinganId);

        // Update field tandatanganpembimbing menjadi "DISETUJUI"
        $bimbingan->update([
            'tandatanganpembimbing' => $tandatanganpembimbing,
        ]);

        // Beri respon JSON atau pesan sesuai kebutuhan
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
