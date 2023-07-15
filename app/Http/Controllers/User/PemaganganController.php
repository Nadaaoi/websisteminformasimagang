<?php

namespace App\Http\Controllers\user;

use App\Models\Pemagangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\pemaganganRequest;
use App\Models\DataUnit;
use App\Models\JadwalPeserta;
use App\Models\JenisProgramMagang;
use App\Models\KebutuhanMagang;
use App\Models\Kota;
use App\Models\ProgramStudi;
use App\Models\Provinsi;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class pemaganganController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return
        $id = Auth::user()->id;
        $pemagangan = Pemagangan::where('user_id', $id)->get();
        $pemagangan_count = pemagangan::where('user_id', $id)->count();
        // return $pemagangan;
        $data_user = User::where('id', $id)->get();
        // return $data_user;
        // return $id;
        if($pemagangan_count == 0){
            $jurusan = ProgramStudi::all();
            // $kebutuhanMagang = KebutuhanMagang::where('hasil_kebutuhan', null)->where('status_kebutuhan', 'DISETUJUI')->get();
            // return $kebutuhanMagang;
            

            return view('user.pemagangan.create',[
                'us' => $data_user,
                'jurusan' => $jurusan,
                'title' => 'Pemagangan',
            ]);
        } else{
           
            // return $data;

            return view('user.pemagangan.index',[
             
                'us' => $pemagangan,
                'title' => 'Pemagangan',
               
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Pemagangan';
        return view('pages.dashboard.user.pemagangan.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        // return ddd();
        $message = [
            'mimes' => 'File Harus Berbentuk PDF',
            'image' => 'File harus berformat gambar',
            'max' => 'Maksimal ukuran file 5 MB',
            'required' => 'Wajib Diisi',
            'npm.min' => 'NPM harus 10 angka',
            'npm.unique' => 'NPM sudah terdaftar',
            'npm.max' => 'NPM Maximal 9 angka',
            'semester.min' => 'Minimal semester 5 untuk D3 dan semester 7 untuk S1',
            'ipk.min' => 'Minimal IPK 2.00',
        ];

        $request->validate([
            'nama'=>'required',
            'npm' => 'required|max:10',
            'tanggalpengajuan' => 'required',
            'fakultas'=>'required',
            'programstudi' => 'required',
            'tahunmasuk' => 'required',
            'jenjangpendidikan' => 'required',
            'kelas' => 'required',
            'ipk' => 'required',
            'semester' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'programmagang' => 'required',
            'namaperusahaan',
            'posisi',
            'tanggalmulai',
            'tanggalselesai',
            'durasimagang',
            'alasanbelummagang',
            'buktipenerimaan' => 'mimes:pdf|file|max:2048',
            'transkrip_nilai' => 'mimes:pdf|file|max:2048',
            'kartumahasiswa' => 'image|file|max:2048',
        ],$message);

        
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Auth::user()->slug;
        $data['nama'] = ucwords($request->nama);

        $nama_path = Str::slug(Auth::user()->name . date('d,h,i,s'));
        
        if($request->jenjangpendidikan === 'S1'){
            if($request->semester > 6){
               $rules['semester'] = 'required|min:6';
            }
        }

        if($request->file('buktipenerimaan')){
            $data['buktipenerimaan'] = $request->file('buktipenerimaan')->storeAs('public/buktipenerimaan', $nama_path . '-buktipenerimaan');
        }
        if($request->file('transkrip_nilai')){
            $data['transkrip_nilai'] = $request->file('transkrip_nilai')->storeAs('public/transkrip_nilai', $nama_path . '-transkrip_nilai');
        }
        if($request->file('kartumahasiswa')){
            $data['kartumahasiswa'] = $request->file('kartumahasiswa')->storeAs('public/kartumahasiswa', $nama_path . '-kartumahasiswa');
        }
        
        $data['user_id'] = Auth::user()->id;
        $data['slug'] = Str::slug(Auth::user()->name .'-' . date('d,h,i,s'));
        pemagangan::create($data);
        return redirect()->route('pemagangan.index')->with('success', 'Status pemagangan kamu berhasil disimpan, mohon periksa pemberitahuan secara berkala!');
    }

    //     pemagangan::create($data);
    //     User::where('id', Auth::user()->id )->update([
    //     ]);
    //     return redirect()->route('Pemagangan.create')->with('success', 'Data pribadi kamu berhasil disimpan, mohon periksa pemberitahuan secara berkala mengenai status kamu !');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(pemagangan $pemagangan)
    // {
    //     // return $pemagangan;
    //     $kebutuhanMagang = KebutuhanMagang::where('hasil_kebutuhan', null)->where('status_kebutuhan', 'DISETUJUI')->get();
    //     return view('pages.dashboard.user.pemagangan.edit', [
    //         'data'  => $pemagangan,
    //         'title' => 'Data Profil Mahasiswa',
    //         'kebutuhanMagang' => $kebutuhanMagang
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemagangan $pemagangan)
    {

        $message = [
            'mimes' => 'File Harus Berbentuk PDF',
            'image' => 'File harus berformat gambar',
            'max' => 'Maksimal ukuran file 5 MB',
            'required' => 'Wajib Diisi',
            'npm.min' => 'NPM harus 10 angka',
            'npm.unique' => 'NPM sudah terdaftar',
            'npm.max' => 'NPM Maximal 9 angka',
            'semester.min' => 'Minimal semester 5 untuk D3 dan semester 7 untuk S1',
            'ipk.min' => 'Minimal IPK 2.00',
        ];

        $request->validate([
            'nama'=>'required',
            'npm' => 'required|max:10',
            'tanggalpengajuan' => 'required',
            'fakultas'=>'required',
            'programstudi' => 'required',
            'tahunmasuk' => 'required',
            'jenjangpendidikan' => 'required',
            'kelas' => 'required',
            'ipk' => 'required',
            'semester' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'programmagang' => 'required',
            'namaperusahaan',
            'posisi',
            'tanggalmulai',
            'tanggalselesai',
            'durasimagang',
            'alasanbelummagang',
        ],$message);

        // return $rules;
        // return $pemagangan;
        // $data = $request->all();
        if($request->npm != $pemagangan->npm){
            $rules['npm'] =  'required|unique|max:10|min:10';
            // die;
        };
        $validatedData = $request->validate($rules, $message);
        // $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['ipk'] = $request->ipk;
        // return $validatedData;
        pemagangan::where('id', $pemagangan->id)->update($validatedData);
        if(Auth::user()->status_akun == 'DITERIMA'){
            return redirect()->route('pemagangan.index')->with('success', 'Data pribadi kamu berhasil disimpan.');

        } 
        return redirect()->route('pemagangan.index')->with('success', 'Data pribadi kamu berhasil disimpan, mohon periksa pemberitahuan secara berkala mengenai status kamu !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tes_id($id)
    {
        return $id;
    }

    public function view_buktipenerimaan($id)
{
    if(Auth::user()->id != $id){
        return redirect()->back();
    }
        
    $path = Pemagangan::where('id', $id)->first();
    $outputfile = url('storage/'.$path->buktipemagangan);

    return response()->file($outputfile);
}


    public function view_transkrip_nilai($id)
    {

        $path = Pemagangan::where('id', $id)->get();
        $outputfile = public_path('storage/'.$path[0]->transkrip_nilai);

        return response()->file($outputfile);
    }

    public function view_kartumahasiswa($id)
    {
        // if(Auth::user()->id != $id){
        //     return redirect()->back();
        // }

        $path = Pemagangan::where('id', $id)->get();
        $outputfile = public_path('storage/'.$path[0]->kartumahasiswa);
      
        return response()->file($outputfile);
    }
}
