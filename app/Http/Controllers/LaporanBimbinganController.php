<?php

namespace App\Http\Controllers;

use App\Exports\BimbinganExport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Pemagangan;
use App\Models\Bimbingan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanBimbinganController extends BaseController
{
    public function index()
    {   
        $title = 'laporanbimbingan';
        $user_id = Auth::user()->id;
    
        // Ambil data pesertamagang berdasarkan id
        $pemagangan = Pemagangan::where('statuspengajuan', 'DITERIMA')->get();

        return view('laporanbimbingan.index', compact('title', 'pemagangan'));
    }

    public function show($user_id)
    {
        // $user_id = Auth::user()->id;
        $laporanbimbingan = Bimbingan::where('user_id', $user_id)->get();
    
        $title = 'laporanbimbingan';
        // dd($laporanbimbingan);
        return view('laporanbimbingan.show', compact('laporanbimbingan','title'));
    }

    public function showPdf($user_id)
    {
        $laporanbimbingan = Bimbingan::where('user_id', $user_id)
                            ->where('tandatanganpembimbing', 'disetujui')
                            ->get();
        $title = 'laporanbimbingan';
    
        // Memanggil fungsi exportPDF() untuk mendapatkan data PDF
        $pdfData = $this->exportPDF($laporanbimbingan);
    
        // Kembalikan tampilan view (tidak harus di sini, tergantung kebutuhan Anda)
        return view('laporanbimbingan.show', compact('laporanbimbingan', 'title'));
    }
    
    public function exportPDF($laporanbimbingan)
{
    // $bimbingan = Bimbingan::where('tandatanganpembimbing', 'disetujui')->get();

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
    $pdf->SetFont('times', 'B', 16); // Font judul diperbesar dan diberi bold
    $pdf->Cell(0, 10, 'LAPORAN KEGIATAN BIMBINGAN UNIVERSITAS BINA INSANI', 0, 1, 'C');
    $pdf->SetFont('times', '', 12); // Kembali ke font biasa
    $pdf->Cell(0, 10, 'Jl. Raya Siliwangi No.6, RT.001/RW.004, Sepanjang Jaya, Kec. Rawalumbu, Kota Bks, Jawa Barat 17114', 0, 1, 'C');

    // Menambahkan spasi setelah judul
    $pdf->Cell(0, 5, '', 0, 1);

    // Header tabel
    $pdf->SetFont('times', 'B', 11); // Font header tabel diberi bold
    $pdf->Cell(25, 10, 'Pertemuan', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Nama Mahasiswa', 1, 0, 'C');
    $pdf->Cell(30, 10, 'NPM', 1, 0, 'C');
    $pdf->Cell(32, 10, 'Tanggal', 1, 0, 'C');
    $pdf->Cell(55, 10, 'Deskripsi Bimbingan', 1, 0, 'C');
    $pdf->Cell(55, 10, 'Hasil Bimbingan', 1, 1, 'C');

    // Isi tabel
    $pdf->SetFont('times', '', 10); // Kembali ke font biasa untuk isi tabel
    foreach ($laporanbimbingan as $p) {
        $pdf->Cell(25, 10, $p->pertemuan, 1, 0, 'C');
        $pdf->Cell(60, 10, $p->nama, 1, 0, 'C');
        $pdf->Cell(30, 10, $p->npm, 1, 0, 'C');
        $pdf->Cell(32, 10, $p->tanggalpengajuan, 1, 0, 'C');
        $pdf->Cell(55, 10, $p->deskripsibimbingan, 1, 0, 'C');
        $pdf->Cell(55, 10, $p->hasilbimbingan, 1, 1, 'C');
    }

    // Mengeluarkan file PDF
    $pdf->Output('laporanbimbingan.pdf', 'D');
}

public function exportExcel($user_id)
{
    $bimbingan = bimbingan::where('user_id', $user_id)->get();

    return Excel::download(new class($bimbingan) implements FromCollection {
        protected $bimbingan;

        public function __construct($bimbingan)
        {
            $this->bimbingan = $bimbingan;
        }

        public function collection()
        {
            return $this->bimbingan;
        }
    }, 'bimbingan.xlsx');
}

}
