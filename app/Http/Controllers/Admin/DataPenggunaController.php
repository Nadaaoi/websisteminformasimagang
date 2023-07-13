<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataPenggunaRequest;
// use App\Models\DataPembimbing;
use App\Models\ProgramStudi;
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
        $programstudi = Programstudi::all();
        $fakultas = Fakultas::all();
        $fakultas_id = Auth::user()->fakultas_id;
        return view('Admin.Pengguna.index',[
            'data_pengguna' => User::all(), 'programstudi' => $programstudi, 'fakultas' => $fakultas, 'fakultas_id' => $fakultas_id,
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
        $title = 'Tambah Pengguna';
        $fakultas = Fakultas::all();
        // $fakultas_id = Auth::user()->fakultas_id;
        $programstudi = Programstudi::all();
        return view('Admin.Pengguna.create', compact('title', 'programstudi', 'fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataPenggunaRequest $request)
    {
        // return $request;
        $data = $request->all();
        // if($request->roles == 'PEMBIMBING' || $request->roles == 'PROGRAMSTUDI'){
        //     $data['name'] = '-';
        // } else{
        //     $data['name'] = $request->name;
        // }
        // $usernamestr = strtolower($request->username);
        // $data['username'] = str_replace(' ', '', $usernamestr);
        $data['slug'] = Str::slug($request->name . date('d,h,i,s'));
        $data['password'] = Hash::make('password');
        // if($request->roles == 'PEMBIMBING' || $request->roles == 'MAHASISWA'){
        //     $str = $request->programstudi;
        //     $u = explode("-",$str);
    
        //     // $data['kode_lokasi'] = $u[0];
        //     // $data['PEMBIMBING_kerja'] = $u[1];
            
        //     // if($request->roles == 'PEMBIMIBNG'){
        //     //     $countUserPEMBIMBING = User::where('roles', 'PEMBIMBING')->where('programstudi',  $u[1] )->where('kode_lokasi', $u[0])->count();
        //     //     // return $countUserPEMBIMBING;
        //     //     if($countUserPEMBIMBING > 0){
        //     //         return redirect()->route('data-pengguna.index')->with('success', 'Akun PEMBIMBING kerja / akun admin sudah dibuat!');
        //     //     }
        //     // }
        //     // if($request->roles == 'ADMIN'){
        //     //     $countUserAdmin = User::where('roles', 'ADMIN')->where('kode_lokasi', $u[0] )->count();
        //     //     // return $countUserAdmin;
        //     //     if($countUserAdmin > 0){
        //     //         return redirect()->route('data-pengguna.index')->with('success', 'Akun PEMBIMBING kerja / akun admin sudah dibuat!');
        //     //     }

        //     // }

           

        //     $data['email_verified_at'] = now();
        //     $data['email'] = null;
        // }

        // if($request->roles == 'MAHASISWA'){
        //     $data['is_khusus'] = 1;
        //     $data['username'] = null;
        // }
      
        // if($request->roles == 'PEMBIMBING' || $request->roles == 'USER' ){
        //     $data['name'] = ucwords($request->name);
        //     $data['email_verified_at'] = now();
        //     $data['username'] = null;
        //     if($request->roles == 'PEMBIMBING'){
        //         $str = $request->programstudi;
        //         $u = explode("-",$str);
        //     }


        // } 
        // return $data;

        User::create($data);
        return redirect()->route('data-pengguna.index')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return $user;
        $title = 'Data Pengguna';
        // $PEMBIMBING = DataPEMBIMBING::all();
        $jurusan = ProgramStudi::all();
        return view('pages.dashboard.admin.data-pengguna.edit2', compact('user', 'title', 'PEMBIMBING'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $userLama =  User::where('slug', $slug)->get();
        

        $message = [
            'required' => 'Wajib Di Isi!',
            'email.unique' => 'Email sudah ada !',
            'username.unique' => 'Username sudah ada !'
        ];
        if ($request->roles == 'PEMBIMBING' || $request->roles == 'ADMIN') {
            if($userLama[0]->username !== $request->username){
                $data = $request->validate([
                    'username' => 'required|unique:users',
                    // 'kode_lokasi' => 'required'
                    
                ], $message);
            } else{
                 $data = $request->all(); 
            }
            
        }
        if ($request->roles == 'PEMBIMBING') {
            if($userLama[0]->email !== $request->email){
                $data = $request->validate([
                    'email' => 'required|unique:users',
                    'name' => 'required'
                    
                ], $message);
            }  else{
                $data = $request->all(); 
            }
            
        }
        if ($request->roles == 'USER') {
            if($userLama[0]->email !== $request->email){
                $data = $request->validate([
                    'email' => 'required|unique:users',
                    'name' => 'required'
                    
                ], $message);
            } else {
                $data = $request->all(); 
            }
            
        }
        // return $data;

        // $data = $request->all();
        // return $data;
        // $data = $user->all();
        // $email = DB::table('users')->where('id', $request->id)->value('id');

        // $data['slug'] = Str::slug($request->name);

        // $data['slug'] = $user->slug;
        // return $id;
        // return $data['PEMBIMBING_kerja'];
       
        
        $user = User::where('slug', $slug);
        if(isset($request->PEMBIMBING_kerja)){
            if($request->roles == 'PEMBIMBING'){
                $str = $request->PEMBIMBING_kerja;
                $u = explode("-",$str);
        
                $data['kode_lokasi'] = $u[0];
                $data['PEMBIMBING_kerja'] = $u[1];
                if($userLama[0]->PEMBIMBING_kerja !== $data['PEMBIMBING_kerja'] = $u[1]){
                    $countUserPEMBIMBING = User::where('roles', 'PEMBIMBING')->where('PEMBIMBING_kerja',  $u[1] )->where('kode_lokasi', $u[0])->count();
                    // return $countUserPEMBIMBING;
                    if($countUserPEMBIMBING > 0){
                        return redirect()->route('data-pengguna.index')->with('success', 'Akun PEMBIMBING kerja / akun admin sudah ada');
                    }

                }
                
                $data['name'] = '-';
                $user->update([
                    'roles' => $data['roles'],
                    'name' => $data['name'],
                    'username' => $data['username'],
                    
                    'PEMBIMBING_kerja' => $data['PEMBIMBING_kerja'],
                    'kode_lokasi' => $data['kode_lokasi']
                ]);
                
            } elseif($request->roles == 'PEMBIMBING'){
             
                $data['name'] = $request->name;
                $str = $request->PEMBIMBING_kerja;
                $u = explode("-",$str);
        
                $data['kode_lokasi'] = $u[0];
                $data['PEMBIMBING_kerja'] = $u[1];
                $user->update([
                    'roles' => $data['roles'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'PEMBIMBING_kerja' => $data['PEMBIMBING_kerja'],
                    'kode_lokasi' => $data['kode_lokasi']
                ]);
            } elseif ($request->roles == 'ADMIN'){
                $str = $request->PEMBIMBING_kerja;
                $u = explode("-",$str);
        
                $data['kode_lokasi'] = $u[0];
                $data['PEMBIMBING_kerja'] = $u[1];
                if($userLama[0]->PEMBIMBING_kerja !== $data['PEMBIMBING_kerja'] = $u[1]){
                    $countUserAdmin = User::where('roles', 'ADMIN')->where('kode_lokasi', $u[0] )->count();
                    if($countUserAdmin > 0 ){
                        return redirect()->route('data-pengguna.index')->with('success', 'Akun PEMBIMBING kerja / akun admin sudah dibuat');
                    }

                }
              
                $user->update([
                    'roles' => $request->roles,
                    'name' => '-',
                    'username' => $data['username'],
                    
                    'PEMBIMBING_kerja' => $data['PEMBIMBING_kerja'],
                    'kode_lokasi' => $data['kode_lokasi']
                ]);

            } else{
                $data['name'] = '-';
                $user->update([
                    'roles' => $data['roles'],
                    'name' => $data['name'],
                    'PEMBIMBING_kerja' => $data['PEMBIMBING_kerja'],
                ]);
            }
            
        }else{
            $user->update([
                'roles' => $data['roles'],
                'name' => $data['name'],
                'email' => $data['email'],
                'PEMBIMBING_kerja' => null,
                'username' => null,
                'kode_lokasi' => null,
            ]);

        }
        
        return redirect()->route('data-pengguna.index')->with('success', 'Data Berhasil Diubah!');
    }
    public function updatePassword(Request $request, $slug)
    {
        // return $request;
        
        $user = User::where('slug', $slug);
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
    public function destroy(User $user)
    {
        //
    }
}
