<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Pemagangan;
use App\Models\Dokumen;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemberitahuanController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Pemagangans = Pemagangan::where('user_id', Auth::user()->id)->count();
        if($Pemagangans == 0){
            return redirect()->route('data-pribadi.index')->with('success', 'Mohon dilengkapi terlebih dahulu sebelum melanjutkan!');
        }
        // if($dokumenC == 0){
        //     return redirect()->route('dokumen.index')->with('success', 'Mohon dilengkapi terlebih dahulu sebelum melanjutkan!');
        // }
        $pemberitahuan = Pemberitahuan::latest()->where('user_id', Auth::user()->id)->get();
        $title = 'Pemberitahuan';
        // return $pemberitahuan;
        return view('pages.dashboard.user.pemberitahuan.index', compact('pemberitahuan', 'title'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
