<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
       $genre = Genre::latest()->get();
        $response = [
            'success' => true,
            'message' => 'Data Genre',
            'data' =>$genre,
        ];
        return response()->json($response, 200);
    }
    public function store(request $request)
    {

        // validasi data
        $validator = Validator::make($request->all(), [
            'nama_genre' => 'required|unique:genres',
        ], [
            'nama_genre.required' => 'Masukan genre',
            'nama_genre.unique' => 'genre Sudah Digunakan',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
           $genre = new Genre;
           $genre->nama_genre = $request->nama_genre;
           $genre->save();
        }

        if ($genre) {
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
       $genre = Genre::find($id);

        if ($genre) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Genre',
                'data' =>$genre,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Genre Tidak Ditemukan',
            ], 404);
        }
    }

    public function update(request $request)
    {

        // validasi data
        $validator = Validator::make($request->all(), [
            'nama_genre' => 'required',
        ], [
            'nama_genre.required' => 'Masukan genre',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'silahkan isi dengan benar',
                'data' => $validator->errors(),
            ], 401);
        } else {
           $genre = new Genre;
           $genre->nama_genre = $request->nama_genre;
           $genre->save();
        }

        if ($genre) {
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
       $genre = Genre::find($id);
        if ($genre) {
           $genre->delete();
            return response()->json([
                'success' => true,
                'message' => 'data' .$genre->nama_genre . 'berhasil dihapus',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }
    }
}
