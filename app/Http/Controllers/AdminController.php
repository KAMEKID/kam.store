<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        $admin->hp = $request->input('hp');
        $admin->save();

        return response()->json([
            'status' => 201,
            'data' => $admin
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
        $admin = admin::find($id);
        if ($admin) {
            return response()->json([
                'status' => 200,
                'data' => $admin
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
        $admin = admin::find($id);
        if ($admin){
            $admin->name = $request->name ? $request->name : $admin->name;
            $admin->username = $request->username ? $request->username : $admin->username;
            $admin->email = $request->email ? $request->email : $admin->email;
            $admin->hp = $request->hp ? $request->hp : $admin->hp;
            $admin->save();
            return response()->json([
                'status' => 200,
                'data' => $admin
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
        $admin = admin::where('id', $id)->first();
        if ($admin){
            $admin->delete();
            return response()->json([
                'status' => 200,
                'data' => $admin
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }
}
