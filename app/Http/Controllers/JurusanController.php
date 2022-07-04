<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
        $jurusan = Jurusan::query()->get();
        $data = [
            'jurusan' => $jurusan
        ];

        return view('pages.jurusan.index', $data);
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
        $validated = $request->validate([
            'nama_jurusan' => 'required',
            'kode_jurusan' => 'required'
        ]);
        $jurusan = Jurusan::create([
            'nama_jurusan' => $request->nama_jurusan,
            'kode_jurusan' => $request->kode_jurusan
        ]);

        return redirect()->back()->with('status', 'Data Jurusan Berhasil Ditambah');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $jurusan = Jurusan::find($id);

        return response()->json(['data' => $jurusan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
     {
        $validated = $request->validate([
        'edit_nama_jurusan' => 'required',
     ]);

     $param = [
        'nama_jurusan' => $request->edit_nama_jurusan,
     ];
     $jurusan = Jurusan::query()->where('id_jurusan', '=', $id)->update($param);
        return redirect()->back()->with('status', 'Data Jurusan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        //
    }
}
