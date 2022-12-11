<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teater;
use Exception;

class TeaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTeater()
    {
        return response()->json(Teater::all(), 200);
    }

    public function getDetailTeater($id)
    {
        $teater = Teater::where('id', $id)->get();
        if (!$teater->isEmpty()) {
            return response()->json($teater, 200);
        } else {
            return response([
                'message' => 'teater tidak ditemukan'
            ], 404);
        }   
    }

    public function insertTeater(Request $request)
    {
        try {
        $teater = new Teater;
        $teater->nama = $request->nama;
        $teater->kapasitas = $request->kapasitas;
        $teater->save();
        return response([
            'statusAPI' => true,
            'message' => 'Teater berhasil ditambah'
        ], 200);
    } catch (Exception $e) {
        return response([
            'statusAPI' => false,
            'message' => 'Teater gagal ditambah'
        ], 404);
    }
}

    public function updateTeater(Request $request, $id)
    {
        $detail_teater = Teater::where('id', $id)->first();

        if ($detail_teater) 
        {
            $teater = Teater::find($id);
            $teater->nama = $request->nama;
            $teater->kapasitas = $request->kapasitas;
            $teater->save();
            return response([
                'statusAPI' => true,
                'message' => 'Teater berhasil diubah'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Teater tidak ditemukan'
            ], 404);
        }
    }

    public function deleteTeater(Request $request, $id)
    {
        $detail_teater = Teater::where('id', $id)->first();

        if ($detail_teater) 
        {
            $teater = Teater::destroy($id);
            if($teater)
            {
                return response([
                    'statusAPI' => true,
                    'message' => 'Teater berhasil dihapus'
                ], 200);
            }
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Teater tidak ditemukan'
            ], 404);
        }
    }
}
