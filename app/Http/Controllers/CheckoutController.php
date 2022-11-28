<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Checkout::all();
        return response()->json([
            "message" => "Riwayat checkout",
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
        $checkout = new Checkout();
        $checkout->nama_produk = $request->input('nama_produk');
        $checkout->harga = $request->input('harga');
        $checkout->jumlah = $request->input('jumlah');
        $checkout->total = $request->input('total');
        $checkout->alamat = $request->input('alamat');
        $checkout->id_transaksi = $request->input('id_transaksi');
        $checkout->save();

        return response()->json([
            'status' => 201,
            'data' => $checkout
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
        $checkout = checkout::find($id);
        if ($checkout) {
            return response()->json([
                'status' => 200,
                'data' => $checkout
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
        $checkout = checkout::find($id);
        if ($checkout){
            $checkout->nama_produk = $request->nama_produk ? $request->nama_produk : $checkout->nama_produk;
            $checkout->harga = $request->harga ? $request->harga : $checkout->harga;
            $checkout->jumlah = $request->jumlah ? $request->jumlah : $checkout->jumlah;
            $checkout->total = $request->total ? $request->total : $checkout->total;
            $checkout->alamat = $request->alamat ? $request->alamat : $checkout->alamat;
            $checkout->waktu_transaksi = $request->waktu_transaksi ? $request->waktu_transaksi : $payment->waktu_transaksi;
            $checkout->save();
            return response()->json([
                'status' => 200,
                'data' => $checkout
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
        $checkout = checkout::where('id', $id)->first();
        if ($checkout){
            $checkout->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil dihapus',
                'data' => $checkout
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }
}
