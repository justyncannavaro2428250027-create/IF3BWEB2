<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = Menu::with('kategori')-> get();
        return response() -> json($menu ,200);
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
        'nama' => 'required|unique:menus',
        'kode' => 'required',
        'kategori_id' => 'required|exists:kategoris,id'
        ]
        );

        $menu = Menu::create($validate);
        if($menu){
            $data['success'] = true;
            $data['messege'] = "Data Menu Berhasil Disimpan";
            $data['data'] = $menu;
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
    $menu = Menu::find($id);

    if (!$menu) {
        return response()->json([
            'success' => false,
            'message' => "Data Menu Tidak Ditemukan"
        ], 404);
    }

    // Validasi
    $validate = $request->validate([
        'nama' => 'required',
        'kode' => 'required',
        'kategori_id' => 'required|exists:kategoris,id'

    ]);

    // Update langsung ke model
    $menu->update($validate);

    return response()->json([
        'success' => true,
        'message' => "Data Menu Berhasil Diperbarui",
        'data' => $menu
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::where('id', $id);
        if($menu){
            $menu ->delete(); //hapus data fakultas berdasarkan id
            $data['success'] = true;
            $data['messege'] = "Data Menu Berhasil Didelete";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['messege'] = "Data Menu tidak ditemukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
    
}
