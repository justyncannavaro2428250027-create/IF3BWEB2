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
        'nama' => 'required|unique:menu',
        'kode' => 'required'
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
       if($menu){ 

       }
        $validate = $request->validate(
        [
        'nama' => 'required',
        'kode' => 'required'
        ]
        );
       Menu::where('id', $id)->update($validate);

         if($menu){
            $data['success'] = true;
            $data['messege'] = "Data Menu Berhasil Diperbarui";
            $data['data'] = $menu;
            return response()->json($data, 201);
        }
     else {
            $data['success'] = false;
            $data['messege'] = "Data Menu Tidak Ditemukan";
        }
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
            $data['messege'] = "Data Fakultas Berhasil Diperbarui";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['messege'] = "Data Fakultas tidak ditemukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
    
}
