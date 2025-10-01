<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function register(Request $request){
        $validate = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);
        // encrypt password (bcrypt)
        $validate['password'] = bcrypt($request->password);

        //simpan data user ke tabel users
        $user = User::create($validate);
        if($user){
            $data['success'] = true;
            $data['message'] = 'User Berhasil Disimpan';
            $data['data'] = $user->name; // nama user
            $data['token'] = $user->createToken('RestoranApp')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED);
        }else {
            $data['success'] = false;
            $data['message'] = 'User Gagal Disimpan';
            return response()->json($data, Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $data['success'] = true;
            $data['message'] = 'Login Berhasil';
            $data['data'] = $user->name;
            $data['token'] = $user->createToken('RestoranApp')->plainTextToken;
            return response()->json($data, Response::HTTP_OK);
        }else {
            $data['success'] = false;
            $data['message'] = 'Email atau Password Salah';
            return response()->json($data, Response::HTTP_UNAUTHORIZED);
        }

    }
}