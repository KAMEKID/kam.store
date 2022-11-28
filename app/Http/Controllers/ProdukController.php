<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Produk::all();
        return response()->json([
            "message" => "List Produk",
            "data" => $tabel
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new Produk();
        $produk->nama = $request->input('nama');
        $produk->harga = $request->input('harga');
        $produk->stok = $request->input('stok');
        $produk->deskripsi = $request->input('deskripsi');
        $produk->save();

        return response()->json([
            'status' => 201,
            'data' => $produk
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = produk::find($id);
        if ($produk) {
            return response()->json([
                'status' => 200,
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id atas ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = produk::find($id);
        if ($produk){
            $produk->nama = $request->nama ? $request->nama : $produk->nama;
            $produk->harga = $request->harga ? $request->harga : $produk->harga;
            $produk->stok = $request->stok ? $request->stok : $produk->stok;
            $produk->deskripsi = $request->deskripsi ? $request->deskripsi : $produk->deskripsi;
            $produk->save();
            return response()->json([
                'status' => 200,
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $id . 'tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = produk::where('id', $id)->first();
        if ($produk){
            $produk->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil dihapus',
                'data' => $produk
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }
}
