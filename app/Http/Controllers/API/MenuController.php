<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
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
        $menu = Menu::with('kategori')->get();
        return response()->json($menu, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:menus',
            'kode' => 'required',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

        $menu = Menu::create($validate);

        if ($menu) {
            return response()->json([
                'success' => true,
                'message' => "Data Menu Berhasil Disimpan",
                'data' => $menu
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => "Data Menu Gagal Disimpan"
        ], 500);
    }

    /**
     * Display the specified resource.
     */
public function show($id)
{
    $menu = Menu::with('kategori')->find($id);

    if ($menu) {
        return response()->json([
            'success' => true,
            'message' => 'Data menu ditemukan',
            'data' => $menu
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Data menu tidak ditemukan'
        ], 404);
    }
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => "Data Menu Tidak Ditemukan"
            ], 404);
        }

        $validate = $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);

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
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if ($menu) {
            $menu->delete();
            return response()->json([
                'success' => true,
                'message' => "Data Menu Berhasil Dihapus"
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Data Menu Tidak Ditemukan"
            ], 404);
        }
    }
}
