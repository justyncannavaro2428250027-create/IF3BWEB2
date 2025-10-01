<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
        [
        'nama' => 'required|unique:kategoris',
        ]
        );

        $kategori = Kategori::create($validate);
        if($kategori){
            $data['success'] = true;
            $data['messege'] = "Data Kategori Berhasil Disimpan";
            $data['data'] = $kategori;
            return response()->json($data, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $kategori = Kategori::find($id);

    if (!$kategori) {
        return response()->json([
            'success' => false,
            'message' => "Data Kategori Tidak Ditemukan"
        ], 404);
    }

    // Validasi
    $validate = $request->validate([
        'nama' => 'required',
    ]);

    // Update langsung ke model
    $kategori->update($validate);

    return response()->json([
        'success' => true,
        'message' => "Data Kategori Berhasil Diperbarui",
        'data' => $kategori
    ], 200);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::where('id', $id);
        if($kategori){
            $kategori ->delete(); //hapus data fakultas berdasarkan id
            $data['success'] = true;
            $data['messege'] = "Data Kategori Berhasil Didelete";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['messege'] = "Data Kategori tidak ditemukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}