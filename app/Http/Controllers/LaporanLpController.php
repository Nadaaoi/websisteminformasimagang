<?php

namespace App\Http\Controllers;

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
use TCPDF;


class laporanLpController extends BaseController
{
    public function index()
    {   
        $title = 'laporanlp';
        $user_id = Auth::user()->id;
    
        // $pemagangan = Pemagangan::get();
        // $laporanlp = LaporanAkhir::where('user_id', $user_id)->get();
        // $pemagangan = Pemagangan::with('laporanAkhir')->get();
        $pemagangan = Pemagangan::where('statuspengajuan', 'DITERIMA')->get();
        $laporanlp = LaporanAkhir::all();
        $laporanlpcount = LaporanAkhir::where('user_id', $user_id)->count();

        // dd($laporanlpcount);
        return view('laporanlp.index', compact('title', 'pemagangan', 'laporanlp','laporanlpcount'));
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
        $path = LaporanAkhir::where('id', $id)->get();
        $outputfile = public_path('storage/'.$path[0]->nilai);
          
        return response()->file($outputfile);
    }

public function exportPDF()
{
    $laporanakhir = LaporanAkhir::all();
                
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
                    $pdf->SetFont('times', 'B', 12);
                    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
                    $pdf->Cell(70, 10, 'Nama Mahasiswa', 1, 0, 'C');
                    $pdf->Cell(50, 10, 'NPM', 1, 0, 'C');
                    $pdf->Cell(70, 10, 'Nama Pembimbing', 1, 0, 'C');
                    $pdf->Cell(60, 10, 'Status Laporan', 1, 1, 'C'); // Use 1 instead of 0 to move to the next line after this cell

                    // Isi tabel
                    $pdf->SetFont('times', '', 11);
                    $nomorUrut = 1;
                    foreach ($laporanakhir as $p) {
                        $pdf->Cell(10, 10, $nomorUrut, 1, 0, 'C');
                        $pdf->Cell(70, 10, $p->nama, 1, 0, 'C');
                        $pdf->Cell(50, 10, $p->NPM, 1, 0, 'C');
                        $pdf->Cell(70, 10, $p->namapembimbing, 1, 0, 'C');
                        $pdf->Cell(60, 10, $p->status_laporan ?? '-', 1, 1, 'C'); // Use 1 instead of 0 to move to the next line after this cell
                        $nomorUrut++;
                    }

                
                    // Mengeluarkan file PDF
                    $pdf->Output('Laporanakhir.pdf', 'D');
}

public function exportExcel()
{
    return Excel::download(new LaporanExport, 'laporanakhir.xlsx');
}
}
