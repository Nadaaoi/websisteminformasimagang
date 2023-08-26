<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Logbook;
use App\Models\Bimbingan;
use App\Models\Pemagangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    public function index()
    {   
        $title = 'Dashboard';
        $user_id = Auth::user()->id;
    
        // Menghitung jumlah logbook berdasarkan user_id yang sedang login
        $pemagangans = Pemagangan::all();
        // $statuspemagangan = Pemagangan::where('statuspenajuan', $statuspengajuan)->get;
        $logbookCount = Logbook::where('user_id', $user_id)->count();
        $bimbinganCount = Bimbingan::where('user_id', $user_id)->count();
        $pemaganganCount = Pemagangan::all()->count();
        $diterimaCount = User::where('status_akun', 'DITERIMA')->count();
        $tidakditerimaCount = User::where('status_akun', 'TIDAK DITERIMA')->count();
        $MSIBCount = Pemagangan::where('programmagang', 'MSIB')
                     ->where('statuspengajuan', 'DITERIMA')
                     ->count();

        $MAGENTACount = Pemagangan::where('programmagang', 'MAGENTA')
                    ->where('statuspengajuan', 'DITERIMA')
                    ->count();

        $MagangregulerCount = Pemagangan::where('programmagang', 'Reguler')
                    ->where('statuspengajuan', 'DITERIMA')
                    ->count();

        $BelumMagangCount = Pemagangan::where('programmagang', 'Belummagang')
                    ->whereNotIn('user_id', function ($query) {
                        $query->select('user_id')
                            ->from('pemagangans')
                            ->whereIn('statuspengajuan', ['DITERIMA', 'TIDAK DITERIMA']);
                    })
                    ->count();

        $terdaftarCount = User::where('roles', 'USER')
                     ->where('status_akun', 'TERDAFTAR')
                     ->count();

        $pemaganganaktif = Pemagangan::where('statuspengajuan', 'DITERIMA')->get();

        // DD($pemaganganaktif);
                     
        $mahasiswaCount = User::where('roles', 'USER')->count();
        $pembimbingCount = User::where('roles', 'PEMBIMBING')->count();
        $informatikaData = [
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 1),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 2),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 3),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 4),
        ];
        $bisnisData = [
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 5),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 6),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 7),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 8),
            $this->countMahasiswaByStatusAndProdi('DITERIMA', 9),
        ];

        // dd($pemagangans);

        // Set bahasa Indonesia
        Carbon::setLocale('id');
        $user_id = Auth::user()->id;

        // Ambil data pemagangan berdasarkan user_id dengan kondisi statuspengajuan == 'DITERIMA'
        $pemagangan = Pemagangan::where('user_id', $user_id)
                                ->where('statuspengajuan', 'DITERIMA')
                                ->get();
        
        // Inisialisasi array untuk menyimpan hasil durasi magang
        $durations = [];
        
        // Inisialisasi array untuk menyimpan hasil durasi magang dengan nama hari dalam ejaan lengkap
        $dateRanges = [];
        
        // Loop melalui setiap data pemagangan
        foreach ($pemagangan as $pemagangans) {
            // Konversi tanggal mulai dan tanggal selesai menjadi objek Carbon
            $startDate = Carbon::parse($pemagangans->tanggalmulai);
            $endDate = Carbon::parse($pemagangans->tanggalselesai);
        
            // Tambahkan hasil ke array dalam format yang diinginkan
            $duration = $startDate->isoFormat('D MMMM YYYY') . ' - ' . $endDate->isoFormat('D MMMM YYYY');
            $durations[] = $duration;
        
            // Tambahkan hasil ke array dengan nama hari dalam ejaan lengkap
            $dateRangeDetail = $startDate->isoFormat('dddd, D MMMM YYYY') . ' - ' . $endDate->isoFormat('dddd, D MMMM YYYY');
            $dateRanges[] = $dateRangeDetail;
        }
        
        // Gabungkan hasil array menjadi satu string terpisah oleh koma
        $dateRange = implode(', ', $durations);
        
        // Gabungkan hasil array dateRanges menjadi satu string terpisah oleh koma
        $dateRangedetail = implode(', ', $dateRanges);

    
        // Mengirimkan hasil count ke view
        return view('dashboard', compact('title',
        'pemagangan',
        'pemagangans',
        'logbookCount',
        'bimbinganCount',
        'pemaganganaktif',
        'dateRange',
        'dateRangedetail',
        'pemaganganCount',
        'tidakditerimaCount',
        'diterimaCount',
        'terdaftarCount',
        'mahasiswaCount',
        'pembimbingCount',
        'informatikaData',
        'bisnisData',
        'MSIBCount',
        'MAGENTACount',
        'MagangregulerCount',
        'BelumMagangCount'));
    }


    public function countMahasiswaByStatusAndProdi($status, $prodi)
    {
    return DB::table('users')
        ->where('status_akun', $status)
        ->where('programstudi', $prodi)
        ->count();
    }
}

