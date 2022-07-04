<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $kelas = Kelas::query()->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')->get();
        $jurusan = Jurusan::query()->get();
        $data = [
            'kelas' => $kelas,
            'jurusan' => $jurusan
        ];

        return view('pages.kelas.index', $data);
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
            'nama_kelas' => 'required',
            'id_jurusan' => 'required',
        ]);
        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'id_jurusan' => $request->id_jurusan,
        ]);

        return redirect()->back()->with('status', 'Data Kelas Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $kelas = Kelas::query()->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')->where('id_kelas', '=', $id)->first();

        return response()->json(['data' => $kelas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
        public function update($id, Request $request)
     {
        $validated = $request->validate([
        'edit_nama_kelas' => 'required',
        'edit_id_jurusan' => 'required',
     ]);

     $param = [
        'nama_kelas' => $request->edit_nama_kelas,
        'id_jurusan' => $request->edit_id_jurusan,
     ];
     $kelas = Kelas::query()->where('id_kelas', '=', $id)->update($param);
        return redirect()->back()->with('status', 'Data Kelas Berhasil Diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        //
    }
}
