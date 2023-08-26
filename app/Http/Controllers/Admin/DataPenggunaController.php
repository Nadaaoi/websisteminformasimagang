<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataPenggunaRequest;
// use App\Models\DataPembimbing;
use App\Models\programstudi;
use App\Models\Fakultas;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DataPenggunaController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Pengguna';
        // $programstudi = programstudi::all();
        return view('Admin.Pengguna.index',[
            'data_pengguna' => User::all(),
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Pengguna';
        $fakultas = Fakultas::all();
        $fakultas_id = Auth::user()->fakultas_id;
        $programstudi = programstudi::all();
        return view('Admin.Pengguna.create', compact('title', 'programstudi', 'fakultas', 'fakultas_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name . date('d,h,i,s'));
        $data['password'] = Hash::make('password');
        
        // Simpan roles terlebih dahulu
        
        $request->validate([
            'npm' => 'sometimes|unique:users,npm,NULL,id,roles,user',
            'nip' => 'sometimes|unique:users,nip,NULL,id,roles,pembimbing',
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
        
        User::create($data);
        
        return redirect('data-pengguna')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengguna = User::find($id);
        // Cek apakah user memiliki data fakultas yang terkait
        // dd($pengguna->fakultas);
        $title = 'Data Pengguna';
        return view('Admin.Pengguna.show', compact('pengguna', 'title'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $pengguna = user::find($id);
    $fakultas = Fakultas::all();
    $programstudi = ProgramStudi::all();
    $title = 'Data Pengguna';
    return view('Admin.Pengguna.edit', compact('pengguna', 'fakultas', 'programstudi', 'title'));
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

    }

    public function updatePassword(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
    
        $request->validate([
            'password' => 'required|min:6', // Pastikan password baru minimal 6 karakter
        ]);
    
        $user->update([
            'password' => Hash::make($request->password)
        ]);
    
        return redirect()->route('data-pengguna.index')->with('success', 'Password Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari data user berdasarkan user_id
        $user = User::find($id);
    
        if ($user) {
            // Hapus data user jika ditemukan
            $user->delete();
            return redirect()->route('data-pengguna.index')->with('success', 'Data Pengguna berhasil dihapus!');
        } else {
            // Tampilkan pesan jika data user tidak ditemukan
            return redirect()->route('data-pengguna.index')->with('error', 'Data Pengguna tidak ditemukan!');
        }
    }
}
