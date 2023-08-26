<?php

namespace App\Http\Controllers\user;

use App\Models\Bimbingan;
use App\Models\Pemagangan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProgramStudi;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BimbinganController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){      
        
        $bimbingan = Bimbingan::where('user_id', Auth::user()->id)->get();
        $title = 'Bimbingan';
        return view('user.bimbingan.index', compact('bimbingan', 'title'));
    }

    public function show($id)
    {
        $user_id = Auth::user()->id;
        $title = 'Bimbingan';
        $bimbingan = Bimbingan::where('user_id', $user_id)
                              ->where('id', $id)
                              ->first();
        
        // dd($bimbingan);
        return view('user.bimbingan.show', compact('title', 'bimbingan'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $title = 'Bimbingan';

        $pemagangan = Pemagangan::where('user_id', $id)->where('statuspengajuan', 'DITERIMA')->first();

        // Menghitung jumlah record bimbingan berdasarkan user_id
        $userBimbinganCount = Bimbingan::where('user_id', $pemagangan->user_id)->count();

        return view('user.bimbingan.create', compact('title', 'pemagangan', 'userBimbinganCount'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;
        $data = array_merge(['user_id' => $user_id], $request->all());
        // dd($data);
        Bimbingan::create($data);
        // dd($data);
        // Bimbingan::create($data);
        
        return redirect('/bimbingan')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
}