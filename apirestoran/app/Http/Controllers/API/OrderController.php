<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::with('menu.kategori')->get();
        return response()->json($order,200);
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
        'kode_order' => 'required',
        'payment_method' => 'required|unique:orders',
        'total_price' => 'required',
        'menu_id' => 'required|exists:menus,id'
        ]
        );

         $order= Order::create($validate);
        if($order){
            $data['success'] = true;
            $data['messege'] = "Data Order Berhasil Disimpan";
            $data['data'] = $order;
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
    $order = Order::find($id);

    if (!$order) {
        return response()->json([
            'success' => false,
            'message' => "Data Order Tidak Ditemukan"
        ], 404);
    }

    // Validasi
    $validate = $request->validate([
        'kode_order' => 'required',
        'payment_method' => 'required',
        'total_price' => 'required',
        'menu_id' => 'required|exists:menus,id'
    ]);

    // Update langsung ke model
    $order->update($validate);

    return response()->json([
        'success' => true,
        'message' => "Data Order Berhasil Diperbarui",
        'data' => $order
    ], 200);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::where('id', $id);
        if($order){
            $order ->delete(); 
            $data['success'] = true;
            $data['messege'] = "Data Order Berhasil Didelete";
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['messege'] = "Data Order tidak ditemukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    
    }
}
