<?php

namespace App\Http\Controllers;

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
use TCPDF;
use Maatwebsite\Excel\Concerns\FromCollection;


class LaporanLogbookController extends BaseController
{
    public function index()
    {   
        $title = 'laporanlogbook';
        $user_id = Auth::user()->id;
    
        // Ambil data pesertamagang berdasarkan id
        $pemagangan = Pemagangan::where('statuspengajuan', 'DITERIMA')->get();

        return view('laporanlogbook.index', compact('title', 'pemagangan'));
    }

    public function show($user_id)
    {
        $logbook = Logbook::where('user_id', $user_id)->get();
        $title = 'laporanlogbook';

    
        // Kembalikan tampilan view (tidak harus di sini, tergantung kebutuhan Anda)
        return view('laporanlogbook.show', compact('logbook', 'title'));
    }

    public function showPdf($user_id)
    {
        $logbook = Logbook::where('user_id', $user_id)->get();
        $title = 'laporanlogbook';
    
        // Memanggil fungsi exportPDF() untuk mendapatkan data PDF
        $pdfData = $this->exportPDF($logbook);
    
        // Kembalikan tampilan view (tidak harus di sini, tergantung kebutuhan Anda)
        return view('laporanlogbook.show', compact('logbook', 'title'));
    }

    
public function exportPDF($logbook)
{
            // $logbook = Logbook::all();
            
        
            // Membuat instance dari TCPDF dengan ukuran kertas landscape
            $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetMargins(15, 15, 15);
            $pdf->AddPage(); // Menambahkan halaman baru

            // Set font
            $pdf->SetFont('times', '', 12);

            // Menambahkan spasi sebelum judul
            $pdf->Cell(0, 20, '', 0, 1);

           // Menyisipkan gambar dan mengatur ukuran dan letak
            $imagePath = public_path('images/biu.JPG');
            $imageWidth = 50; // Lebar gambar dalam mm
            $imageX = ($pdf->getPageWidth() - $imageWidth) / 2; // Posisi gambar di tengah halaman

            $pdf->Image($imagePath, $imageX, 20, $imageWidth, 0, 'JPG');

            // Judul PDF
            $pdf->SetFont('times', 'B', 16);
            $pdf->Cell(0, 10, 'LAPORAN KEGIATAN PEMAGANGAN UNIVERSITAS BINA INSANI', 0, 1, 'C');
            $pdf->SetFont('times', '', 12);
            $pdf->Cell(0, 10, 'Jl. Raya Siliwangi No.6, RT.001/RW.004, Sepanjang Jaya, Kec. Rawalumbu, Kota Bks, Jawa Barat 17114', 0, 1, 'C');

        // Menambahkan spasi setelah judul
            $pdf->Cell(0, 5, '', 0, 1);

            // Header tabel
            // Atur lebar sel
            $noWidth = 10;
            $nameWidth = 70;
            $dateWidth = 30;
            $statusWidth = 60;
            $reasonWidth = 60;

            // Atur font
            $pdf->SetFont('times', 'B', 12);

            // Header tabel
            $pdf->Cell($noWidth, 10, 'No', 1, 0, 'C');
            $pdf->Cell($nameWidth, 10, 'Nama Mahasiswa', 1, 0, 'C');
            $pdf->Cell($dateWidth, 10, 'Tanggal', 1, 0, 'C');
            $pdf->Cell($statusWidth, 10, 'Status Kehadiran', 1, 0, 'C');
            $pdf->Cell($reasonWidth, 10, 'Alasan Ketidakhadiran', 1, 0, 'C');
            $pdf->Ln(); // Pindah baris

            // Atur font untuk isi tabel
            $pdf->SetFont('times', '', 11);
            $nomorUrut = 1;

            // Isi tabel
            foreach ($logbook as $p) {
                $pdf->Cell($noWidth, 10, $nomorUrut, 1, 0, 'C');
                $pdf->Cell($nameWidth, 10, $p->name, 1, 0, 'C');
                $pdf->Cell($dateWidth, 10, $p->date, 1, 0, 'C');
                $pdf->Cell($statusWidth, 10, $p->status_kehadiran, 1, 0, 'C');
                $pdf->Cell($reasonWidth, 10, $p->alasan_ketidakhadiran ?? '-', 1, 0, 'C');
                $pdf->Ln(); // Pindah baris
                $nomorUrut++;
            }

        
            // Mengeluarkan file PDF
            $pdf->Output('laporanlogbook.pdf', 'D');
}

// public function exportExcel()
// {
//     return Excel::download(new LogbookExport, 'logbook.xlsx');
// }

public function exportExcel($user_id)
{
    $logbook = Logbook::where('user_id', $user_id)->get();

    return Excel::download(new class($logbook) implements FromCollection {
        protected $logbook;

        public function __construct($logbook)
        {
            $this->logbook = $logbook;
        }

        public function collection()
        {
            return $this->logbook;
        }
    }, 'logbook.xlsx');
}


}
