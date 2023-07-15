<?php

namespace App\Http\Controllers\admin;

use App\Models\Fakultas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;

class DataFakultasController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fakultas = fakultas::all();
        $title = 'Data Fakultas';
        return view('admin.fakultas.index',[
        ], compact('fakultas','title'));

        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Fakultas';
        return view('admin.fakultas.create',[
        ], compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => 'Wajib di isi!',
        ];
        $validatedData = $request->validate([
            'fakultas' => 'required',
            'ketua_fakultas' => 'required'

        ], $message);

        $validatedData['slug'] = Str::slug($request->fakultas);
        // return $data;

        fakultas::create($validatedData);
        return redirect()->route('data-fakultas.index');
        // ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function show(fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function edit(fakultas $fakultas)
    {
        return view('admin.fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        fakultas::where('id', $id)->update([
            'fakultas' => $request->fakultas,
            'ketua_fakultas' =>  strtoupper($request->ketua_fakultas) ,
        ]);
        return redirect()->route('data-fakultas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\fakultas  $fakultas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Auth::user()->roles == 'SUPER_ADMIN' )
        {
            fakultas::destroy($id);
            return redirect()->route('data-fakultas.index');
        //     ->with('success', 'Data berhasil dihapus!');
        }
        return redirect()->back();
    }

    public function getdatafakultas($id)
    {
        $data = fakultas::where('id', $id)->get();
        
        echo json_encode($data);
    }
}
