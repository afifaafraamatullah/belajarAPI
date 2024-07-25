<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = kategori::latest()->get();
        $response = [
            'success' => true,
            'message' => 'Data Kategori',
            'data' => $kategori,
        ];
        return response()->json($response, 200);
    }
    public function store(request $request)
    {

        // validasi data
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|unique:kategori',
        ], [
            'nama_kategori.required' => 'Masukan Kategori',
            'nama_kategori.unique' => 'Kategori Sudah Digunakan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }

        if ($kategori) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil disimpan',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data gagal disimpan',
            ], 400);
        }
    }

    public function show($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Kategori',
                'data' => $kategori,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kategori Tidak Ditemukan',
            ], 404);
        }
    }

    public function update(request $request)
    {

        // validasi data
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required',
        ], [
            'nama_kategori.required' => 'Masukan Kategori',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
            $kategori = new Kategori;
            $kategori->nama_kategori = $request->nama_kategori;
            $kategori->save();
        }

        if ($kategori) {
            return response()->json([
                'success' => true,
                'message' => 'data berhasil Diperbarui',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data gagal diperbarui',
            ], 400);
        }
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) {
            $kategori->delete();
            return response()->json([
                'success' => true,
                'message' => 'data' . $kategori->nama_kategori . 'berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }
    }
}

