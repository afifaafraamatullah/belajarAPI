<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActorController extends Controller
{
        public function index()
        {
            $actor = Actor::latest()->get();
            $response = [
                'success' => true,
                'message' => 'Data Actor',
                'data' => $actor,
            ];
            return response()->json($response, 200);
        }
        public function store(request $request)
        {

            // validasi data
            $validator = Validator::make($request->all(), [
                'nama_actor' => 'required|unique:actor',
                'biodata' => 'required',
            ], [
                'nama_actor.required' => 'Masukan Actor',
                'nama_actor.unique' => 'actor Sudah Digunakan',
                'biodata.required' => 'Masukan Biodata',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'silahkan isi dengan benar',
                    'data' => $validator->errors(),
                ], 401);
            } else {
                $actor = new Actor;
                $actor->nama_actor = $request->nama_actor;
                $actor->biodata = $request->biodata;
                $actor->save();
            }

            if ($actor) {
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
            $actor = Actor::find($id);

            if ($actor) {
                return response()->json([
                    'success' => true,
                    'message' => 'Detail Actor',
                    'data' => $actor,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'actor Tidak Ditemukan',
                ], 404);
            }
        }

        public function update(request $request)
        {

            // validasi data
            $validator = Validator::make($request->all(), [
                'nama_actor' => 'required',
                'biodata' => 'required',
            ], [
                'nama_actor.required' => 'Masukan Actor',
                'biodata.required' => 'Masukan Biodata',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'silahkan isi dengan benar',
                    'data' => $validator->errors(),
                ], 401);
            } else {
                $actor = new Actor;
                $actor->nama_actor = $request->nama_actor;
                $actor->biodata = $request->biodata;
                $actor->save();
            }

            if ($actor) {
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
            $actor = Actor::find($id);
            if ($actor) {
                $actor->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'data' . $actor->nama_actor . 'berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data tidak ditemukan',
                ], 404);
            }
        }
    }


