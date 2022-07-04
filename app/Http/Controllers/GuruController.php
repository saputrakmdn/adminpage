<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
        {
        $guru = Guru::query()->get();
        $data = [
            'guru' => $guru
        ];

        return view('pages.guru.index', $data);
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
            'nip' => 'required|unique:guru|numeric',
            'nama_guru' => 'required',
            "username" => "required:unique:guru",
            "password" => "required",
        ]);
        $guru = Guru::create([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            "username" => $request->username,
            "password" => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Data Guru Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::find($id);

        return response()->json(['data' => $guru]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
   public function update($id, Request $request)
    {
        $validated = $request->validate([
            'edit_nip' => 'required|numeric|unique:guru,nip,'.$id.',id_guru',
            'edit_nama_guru' => 'required',
            "edit_username" => "required:unique:guru,username,".$id.",id_guru",
        ]);

        $param = [
            'nip' => $request->edit_nip,
            'nama_guru' => $request->edit_nama_guru,
            "jenis_kelamin" => $request->edit_jenis_kelamin,
            "username" => $request->edit_username,
        ];
        if(!is_null($request->edit_password))
            $param['password'] = Hash::make($request->edit_password);

        $guru = Guru::query()->where('id_guru', '=', $id)->update($param);
        return redirect()->back()->with('status', 'Data Guru Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
    }
}
