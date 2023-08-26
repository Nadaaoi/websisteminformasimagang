<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use App\Models\Logbook;
use App\Models\Pemagangan;

class LogbookController extends Controller
{
    public function index()
    {
        // Set bahasa Indonesia
        // Carbon::setLocale('id');
    
        // Hitung tanggal awal dan akhir minggu ini (Senin hingga Jumat)
        $startOfWeek = Carbon::now()->startOfWeek(); // Tanggal awal minggu ini (Senin)
        $endOfWeek = Carbon::now()->endOfWeek()->subDays(2); // Tanggal akhir minggu ini (Jumat)
    
        // Formatkan range tanggal dalam bentuk yang diinginkan (misalnya: "Senin, 01 Januari 2023 - Jumat, 05 Januari 2023")
        $dateRange = $startOfWeek->isoFormat('dddd, D MMMM YYYY') . ' - ' . $endOfWeek->isoFormat('dddd, D MMMM YYYY');
    
        // Array untuk menyimpan div card berdasarkan hari
        $days = [];
    
        // Loop untuk setiap hari dalam minggu
        for ($date = $startOfWeek->copy(); $date <= $endOfWeek; $date->addDay()) {
        // Formatkan tanggal dalam bentuk yang diinginkan (misalnya: "Senin, 01 Januari 2023")
        
        $formattedDate = $date->isoFormat('dddd, D MMMM YYYY');
        // Tanggal awal dan akhir hari
        $startDate = $date->copy()->isoFormat('D MMMM YYYY');
        $startDay= $date->copy()->isoFormat('dddd');

        // Hitung jumlah logbook untuk tanggal ini
        $logbookCount = Logbook::where('user_id', auth()->user()->id)
            ->where('date', $date->toDateString())
            ->count();

        $logbook = Logbook::where('user_id', auth()->user()->id)
            ->where('date', $date->toDateString())
            ->first();

        $emoji = $this->getEmojiForDay(auth()->user()->id, $date);
        

        $days[] = [
                    'date' => $formattedDate,
                    'start_date' => $startDate,
                    'start_day' => $startDay,
                    'logbook_count' => $logbookCount,
                    'status_kehadiran' => $logbook ? $logbook->status_kehadiran : '-',
                    'deskripsi_tugas' => $logbook ? $logbook->deskripsi_tugas : '-',
                    'alasan_ketidakhadiran' => $logbook ? $logbook->alasan_ketidakhadiran : '-',
                    'emoji' => $emoji,
                    'start_date' => $startDate,
                ];
        }
    
        $title = 'logbook';
        $user_id = auth()->user()->id;
        // $logbookCounts = $this->getLogbookCounts($startOfWeek, $endOfWeek);
        $pemagangan = Pemagangan::where('user_id', $user_id)
                        ->value('slug');
                        
        // dd($logbooks->toArray());
        // dd($logbook);
        return view('user.logbook.index', compact('title', 'dateRange', 'days', 'pemagangan'));
    }
    

    public function show(){

    }

public function store(Request $request){

    //     $request->validate([
    //         'date' => 'required|date',
    //         'status_kehadiran' => 'required|in:hadir,tidak_hadir',
    //         'deskripsi_tugas' => 'nullable|string',
    //         'alasan_ketidakhadiran' => 'nullable|string',

    // Ambil nilai id dari record pemagangans yang sesuai berdasarkan input pemagangan_slug pada form

    $data = $request->all();
    // $data['pemagangan'] = $request->input('pemagangan_id');

    if ($request->status_kehadiran === 'Hadir') {
        $data['deskripsi_tugas'] = $request->deskripsi_tugas;
        $data['alasan_ketidakhadiran'] = null;
    } else {
        $data['deskripsi_tugas'] = null;
        $data['alasan_ketidakhadiran'] = $request->alasan_ketidakhadiran;
    }

        Carbon::setLocale('id');
        // Ambil nilai tanggal dari form (misalnya dari input dengan nama 'tanggal')
        $tanggal = $request->input('date');

        // Ubah format tanggal menjadi "Y-m-d"
        
        $tanggalFormatted = Carbon::createFromFormat('d F Y', $tanggal)->format('Y-m-d');

        // Simpan tanggal yang sudah diubah formatnya ke dalam database
        $data['date'] = $tanggalFormatted;
    // dd($data);
    Logbook::create($data);
    return redirect()->route('logbook.index')->with('success', 'Laporan harian berhasil disimpan!');
}

    public function destroy(){

    }

    private function getEmojiForDay($user_id, $date)
    {
        $logbookCountforemoji = Logbook::where('user_id', $user_id)
                        ->where('date', $date->toDateString())
                        ->count();
    
        if ($logbookCountforemoji > 0) {
            $emoji_title = "Sudah diisi";
            return '😄 '; // Emoji jika sudah ada input logbook
        } else {
            $emoji_title = "Belum diisi";
            return '😞'; // Emoji jika belum ada input logbook
        }
    }
}
