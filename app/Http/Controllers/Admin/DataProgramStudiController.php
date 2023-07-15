<?php

namespace App\Http\Controllers\admin;

use App\Models\ProgramStudi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;

class DataProgramStudiController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programstudi = programstudi::all();
        $title = 'Data Program Studi';
        return view('admin.ProgramStudi.index',[
        ], compact('programstudi','title'));

        
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Data Program Studi';
        return view('admin.ProgramStudi.create',[
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
            'programstudi' => 'required',
            'kajur' => 'required'

        ], $message);

        $validatedData['slug'] = Str::slug($request->programstudi);
        // return $data;

        ProgramStudi::create($validatedData);
        return redirect()->route('data-programstudi.index');
        // ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramStudi  $ProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramStudi $ProgramStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramStudi  $ProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramStudi $ProgramStudi)
    {
        return view('admin.ProgramStudi.edit', compact('Programstudi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgramStudi  $ProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ProgramStudi::where('id', $id)->update([
            'programstudi' => $request->programstudi,
            'kajur' =>  strtoupper($request->kajur) ,
        ]);
        return redirect()->route('data-programstudi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgramStudi  $ProgramStudi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( Auth::user()->roles == 'SUPER_ADMIN' )
        {
            ProgramStudi::destroy($id);
            return redirect()->route('data-programstudi.index');
        //     ->with('success', 'Data berhasil dihapus!');
        }
        return redirect()->back();
    }

    public function getDataProgramStudis($id)
    {
        $data = ProgramStudi::where('id', $id)->get();
        
        echo json_encode($data);
    }
}
