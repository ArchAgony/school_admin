<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        // mencari seluruh data
        $data = School::all();

        // menampilkan data yang sebelumnya dicari
        return response()->json([
            'data' => $data
        ]);
    }

    public function show(string $id)
    {
        // mencari data berdasarkan id
        $data = School::where('id', $id)->first();

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
            'name' => 'required|unique:schools,name',
            // validasi untuk mengecek adanya id pada table city
            'city_id' => 'required|exists:cities,id'
        ], [
            // jika kota sudah ada, maka kode ini akan berjalan
            'name.unique' => 'school with name ' . $request->name . ' already exist'
        ]);

        // membuat data berdasarkan fillable di model
        $data = School::create($request->all());

        // membuat pesan jika kota berhasil ditambah
        if ($data) {
            return response()->json([
                'message' => 'school created successfully',
                'data' => $data
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        // membuat validasi yang bertujuan untuk mengecek kondisi kota
        // jika menu kota tidak diisi, maka error bawaan laravel akan berjalan
        $request->validate([
            'name' => 'required|unique:schools,id',
            // validasi untuk mengecek adanya id pada table city
            'city_id' => 'required|exists:cities,id'
        ]);

        // mencari data berdasarkan id
        $data = School::where('id', $id)->first();

        // jika kota yang dipilih tidak ada, maka kode ini akan berjalan
        if (!$data) {
            return response()->json([
                'message' => 'kota with name ' . $data . ' does not exist'
            ]);
        }

        // mengubah data dari id yang dipilih
        $data->update($request->all());

        // membuat pesan jika data berhasil diubah
        return response()->json([
            'data' => $data
        ]);
    }

    public function destroy(string $id)
    {
        $data = School::find($id);

        if (!$data) {
            return response()->json([
                'message' => 'school with id '.$id.' does not exist'
            ]);
        }

        $data->delete();

        return response()->json([
            'message' => 'school successfully deleted',
            'data' => $data
        ]);
    }
}
