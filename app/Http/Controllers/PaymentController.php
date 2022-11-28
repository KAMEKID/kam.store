<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Payment::all();
        return response()->json([
            "message" => "List Pembayaran",
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
        $payment = new Payment();
        $payment->tanggal_transaksi = $request->input('tanggal_transaksi');
        $payment->waktu_transaksi = $request->input('waktu_transaksi');
        $payment->id_transaksi = $request->input('id_transaksi');
        $payment->rekening_tujuan = $request->input('rekening_tujuan');
        $payment->nama_penerima = $request->input('nama_penerima');
        $payment->bank_tujuan = $request->input('bank_tujuan');
        $payment->nama_pengirim = $request->input('nama_pengirim');
        $payment->nominal = $request->input('nominal');
        $payment->save();

        return response()->json([
            'status' => 201,
            'data' => $payment
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
        $payment = payment::find($id);
        if ($payment) {
            return response()->json([
                'status' => 200,
                'data' => $payment
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
        $payment = payment::find($id);
        if ($payment){
            $payment->tanggal_transaksi = $request->tanggal_transaksi ? $request->tanggal_transaksi : $payment->tanggal_transaksi;
            $payment->waktu_transaksi = $request->waktu_transaksi ? $request->waktu_transaksi : $payment->waktu_transaksi;
            $payment->id_transaksi = $request->id_transaksi ? $request->id_transaksi : $payment->id_transaksi;
            $payment->rekening_tujuan = $request->rekening_tujuan ? $request->rekening_tujuan : $payment->rekening_tujuan;
            $payment->nama_penerima = $request->nama_penerima ? $request->nama_penerima : $payment->nama_penerima;
            $payment->bank_tujuan = $request->bank_tujuan ? $request->bank_tujuan : $payment->bank_tujuan;
            $payment->nama_pengirim = $request->nama_pengirim ? $request->nama_pengirim : $payment->nama_pengirim;
            $payment->nominal = $request->nominal ? $request->nominal : $payment->nominal;
            $payment->save();
            return response()->json([
                'status' => 200,
                'data' => $payment
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
        $payment = payment::where('id', $id)->first();
        if ($payment){
            $payment->delete();
            return response()->json([
                'status' => 200,
                'message' => 'data berhasil dihapus',
                'data' => $payment
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }
}
