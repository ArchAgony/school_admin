<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        // mencari seluruh data
        $data  = City::all();

        // menampilkan data yang sebelumnya dicari
        return response()->json([
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        // mencari data berdasarkan id
        $data = City::where('id', $id)->first();
        // menampilkan data berdasarkan id yang dicari sebelumnya
        return response()->json([
            'data' => $data
        ]);
    }

    public function create(Request $request)
    {
        // membuat validasi yang bertujuan untuk mengecek kondisi kota
        // jika menu kota tidak diisi, maka error bawaan laravel akan berjalan
        $request->validate([
            'name' => 'required|unique:cities,name'
        ], [
            // jika kota sudah ada, maka kode ini akan berjalan
            'name.unique' => 'kota with name ' . $request->name . ' already exist'
        ]);

        // membuat data berdasarkan fillable di model
        $data = City::create($request->all());

        // membuat pesan jika kota berhasil ditambah
        return response()->json([
            'message' => 'kota berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        // membuat validasi yang bertujuan untuk mengecek kondisi kota
        // jika menu kota tidak diisi, maka error bawaan laravel akan berjalan
        $request->validate([
            'name' => 'required|unique:cities,name'
        ], [
            // jika kota sudah ada, maka kode ini akan berjalan
            'name.unique' => 'kota with name ' . $request->name . ' already exist'
        ]);

        // mencari data berdasarkan id
        $data = City::where('id', $id)->first();

        // jika kota yang dipilih tidak ada, maka kode ini akan berjalan
        if (!$data) {
            return response()->json([
                'message' => 'kota with name '.$data.' does not exist'
            ]);
        }

        // mengubah data dari id yang dipilih
        $data->update($request->all());

        // membuat pesan jika data berhasil diubah
        return response()->json([
            'message' => 'berhasil diubah',
            'data' => $data
        ]);
    }

    public function destroy(Request $request, string $id)
    {
        //
        // Mencari data berdasarkan ID
        $data = City::find($id);

        // Jika data tidak ditemukan
        if (!$data) {
            return response()->json([
                'message' => 'City with ID ' . $id . ' does not exist.'
            ], 404);
        }

        // Menghapus data
        $data->delete();

        // Mengembalikan pesan jika data berhasil dihapus
        return response()->json([
            'message' => 'City successfully deleted.',
            'data' => $data
        ]);
    }
}
