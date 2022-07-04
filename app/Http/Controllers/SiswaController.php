<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Kelas;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::query()->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')->get();
        $kelas = Kelas::query()->get();
        $data = [
            'siswa' => $siswa,
            'kelas' => $kelas
        ];

        return view('pages.siswa.index', $data);
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
            'nis' => 'required|unique:siswa|numeric',
            'nama_siswa' => 'required',
            "tempat_lahir" => "required",
            "tanggal_lahir" => "required",
            "jenis_kelamin" => "required",
            "alamat" => "required",
            "foto_siswa" => "required",
            "id_kelas" => "required",
            "username" => "required:unique:siswa",
            "password" => "required",
        ]);
        $path = Storage::disk('public_uploads')->putFile('foto_siswa', $request->file('foto_siswa'));
        $siswa = Siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "alamat" => $request->alamat,
            "foto_siswa" => $path,
            "id_kelas" => $request->id_kelas,
            "username" => $request->username,
            "password" => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Data Siswa Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $siswa = Siswa::find($id);

        return response()->json(['data' => $siswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
     {
        $validated = $request->validate([
            'edit_nis' => 'required|numeric|unique:siswa,nis,'.$id.',id_siswa',
            'edit_nama_siswa' => 'required',
            "edit_tempat_lahir" => "required",
            "edit_tanggal_lahir" => "required",
            "edit_jenis_kelamin" => "required",
            "edit_alamat" => "required",
            "edit_foto_siswa" => "required",
            "edit_id_kelas" => "required",
            "edit_username" => "required:unique:siswa,username,".$id.",id_siswa",
        ]);

        $param = [
            'nis' => $request->edit_nis,
            'nama_siswa' => $request->edit_nama_siswa,
            "tempat_lahir" => $request->edit_tempat_lahir,
            "tanggal_lahir" => $request->edit_tanggal_lahir,
            "jenis_kelamin" => $request->edit_jenis_kelamin,
            "alamat" => $request->edit_alamat,
            "foto_siswa" => $request->edit_foto_siswa,
            "id_kelas" => $request->edit_id_kelas,
            "username" => $request->edit_username,
        ];
        if(!is_null($request->edit_password))
            $param['password'] = Hash::make($request->edit_password);

        $siswa = Siswa::query()->where('id_siswa', '=', $id)->update($param);
        return redirect()->back()->with('status', 'Data Siswa Berhasil Diubah');
    }
        
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $siswa = Siswa::query()->where('id_siswa', '=', $id)->delete();
        return redirect()->back()->with('status', 'Data Siswa Berhasil Dihapus');
    }
}
