<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // membuat validasi atau kolom yang perlu diisi
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // menambah seluruh inputan ke database
        $user = User::create($request->all());

        // membuat pesan jika kondisi terpenuhi
        return response()->json([
            'message' => 'user berhasil ditambahkan',
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        // membuat validasi untuk inputan
        $validasi = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // melakukan authentikasi berdasarkan data yang telah di validasi
        $auth =  Auth::attempt(['email' => $validasi['email'], 'password' => $validasi['password']]);

        // membuat token saat sudah login yang digunakan untuk dapat mengakses menu lain
        $user = Auth::user()->createToken('auth-token')->plainTextToken;

        // membuat kondisi jika sudah di validasi
        if ($auth) {
            // $auth->update(['remember_token'=>$token]);
            return response()->json([
                'message' => 'berhasil login',
                'token' => $user
            ]);
        }

        // membuat kondisi jika gagal melakukan validasi
        return response()->json([
            'message' => 'gagal login'
        ]);
    }

    public function logout()
    {
        $user = Auth::user();

        // Pastikan user tidak null
        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan atau belum login'
            ], 401);
        }

        // Menghapus semua token user
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil logout'
        ], 200);
    }
}
