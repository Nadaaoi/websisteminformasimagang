<?php

namespace App\Http\Controllers\pembimbing;

use App\Models\User;
use App\Models\Pemagangan;
use Illuminate\Http\Request;
use App\Models\Pemberitahuan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class DaftarPendaftarPembimbingController extends ControllerResolver
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user() && Auth::user()->roles == 'PEMBIMBING') {
            $selectedYear = $request->input('year', date('Y'));
            
            $us = DB::table('pemagangans')
                ->join('users', 'pemagangans.user_id', '=', 'users.id')
                ->select('users.*', 'pemagangans.*')
                ->whereYear('pemagangans.created_at', $selectedYear)
                ->orderByDesc('pemagangans.created_at')
                ->get();

            return view('pembimbing.daftar-pendaftar.index', [
                'us' => $us,
                'title' => 'Data Calon Magang',
                'selectedYear' => $selectedYear
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function edit(Pemagangan $Pemagangan)
{
    if (Auth::user() && Auth::user()->roles == 'PEMBIMBING') {
        $title = 'Data Calon Magang';
        $pembimbingRole = User::where('roles', 'PEMBIMBING')->get();
        $user = User::where('id', $Pemagangan->user_id)->get();

        // Mendapatkan id_pembimbing yang dipilih dari form
        $id_pembimbing = request('id_pembimbing_selected');

        // dd($pembimbingRole);
        return view('Pembimbing.daftar-pendaftar.edit', [
            'data' => $Pemagangan,
            'title' => $title,
            'pembimbingRole' => $pembimbingRole,
            'user' => $user,
            'id_pembimbing' => $id_pembimbing, // Menyimpan id_pembimbing yang dipilih
        ]);
    }
}

public function show(Pemagangan $Pemagangan)
{
    if (Auth::user() && Auth::user()->roles == 'PEMBIMBING') {
        $title = 'Data Calon Magang';
        $user = User::where('id', $Pemagangan->user_id)->get();

        // dd($pembimbingRole);
        return view('Pembimbing.daftar-pendaftar.show', [
            'data' => $Pemagangan,
            'title' => $title,
            'user' => $user,
        ]);
    }
}

public function showbelummagang(Pemagangan $Pemagangan)
{
    if (Auth::user() && Auth::user()->roles == 'PEMBIMBING') {
        $title = 'Data Calon Magang';
        $user = User::where('id', $Pemagangan->user_id)->get();

        // dd($pembimbingRole);
        return view('Pembimbing.daftar-pendaftar.showbelummagang', [
            'data' => $Pemagangan,
            'title' => $title,
            'user' => $user,
        ]);
    }
}
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
    
        if (Auth::user() && Auth::user()->roles == 'PEMBIMBING') {
    
            $data['slug'] = $request->input('slug');
    
    
            $namapembimbing = $request->input('namapembimbing_selected');
    
            $user = User::where('name', $namapembimbing)->first();
    
            if ($user) {
                // Jika user dengan namapembimbing yang dipilih ditemukan, gunakan user_id tersebut
                $user_id = $user->id;
            } else {
                // Jika tidak ditemukan, berikan nilai default atau berikan error sesuai kebutuhan
                $user_id = null; // Atau bisa juga berikan nilai default berdasarkan kasus Anda
                // Contoh: $user_id = 1; // Jika ingin memberikan nilai default berupa user_id tertentu
            }
    
            $pemagangan = Pemagangan::where('slug', $data['slug'])->first();
    
            if ($pemagangan) {
                // Jika data Pemagangan dengan user_id tersebut ditemukan, update field 'namapembimbing' dan 'id_pembimbing'
                $pemagangan->namapembimbing = $data['namapembimbing'];
                $pemagangan->id_pembimbing = $user_id;
    
                $pemagangan->save();
            } else {
                // Jika tidak ditemukan, buat data baru dengan user_id, namapembimbing, dan id_pembimbing
                $pemagangan = Pemagangan::create([
                    'user_id' => $id,
                    'namapembimbing' => $data['namapembimbing'],
                    'id_pembimbing' => $user_id
                ]);
            }
        }
        
    
        return redirect()->route('daftar-pendaftar-pembimbing.index')->with('success', 'Data Berhasil Disimpan!');
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
