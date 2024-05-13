<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::all();
        return response()->json([
            'data' => $anggota
        ]);
    }

    public function list()
    {
        return view('anggota.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama_anggota' => 'required',
        'alamat' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:anggota,email', // Menambahkan validasi unique untuk email
        // 'password' => 'required|min:8'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $validator->errors()
        ], 422);
    }

    // Simpan data anggota baru
    $input = $request->all();
    $anggota = Anggota::create([
        'nama_anggota' => $input['nama_anggota'],
        'alamat' => $input['alamat'],
        'username' => $input['username'],
        'email' => $input['email'],
        // 'password' => Hash::make($input['password'])
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Anggota berhasil didaftarkan',
        'data' => $anggota
    ], 201);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return response()->json([
            'data' => $anggota
        ]);
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
        $validator = Validator::make($request->all(), [
            'nama_anggota' => 'required',
            'username' => 'required',
            'email' => 'required',
            'alamat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $anggota
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
