<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Exception;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTransaksi()
    {
        return response()->json(Transaksi::with('jadwal')->with('kursi')->get(), 200);
    }

    public function getDetailTransaksi($id)
    {
        $transaksi = Transaksi::where('id', $id)->get();
        if (!$transaksi->isEmpty()) {
            return response()->json($transaksi, 200);
        } else {
            return response([
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }   
    }

    public function insertTransaksi(Request $request)
    {
        try {
        $transaksi = new Transaksi;
        $transaksi->jadwal_id = $request->jadwal_id;
        $transaksi->kursi_id = $request->kursi_id;
        $transaksi->jumlah_dibayar = $request->jumlah_dibayar;
        $transaksi->bukti_pembayaran = md5($request->bukti_pembayaran);
        $transaksi->status = $request->status;
        $transaksi->save();

        return response([
            'statusAPI' => true,
            'message' => 'Transaksi berhasil ditambah'
        ], 200);
    }catch (Exception $e) {
        return response([
            'statusAPI' => false,
            'message' => 'Transaksi gagal ditambah'
        ], 404);
    }
}

    public function updateTransaksi(Request $request, $id)
    {
        $detail_transaksi = Transaksi::where('id', $id)->first();

        if ($detail_transaksi) 
        {
            $transaksi = Transaksi::find($id);
            $transaksi->jadwal_id = $request->jadwal_id;
            $transaksi->kursi_id = $request->kursi_id;
            $transaksi->jumlah_dibayar = $request->jumlah_dibayar;
            $transaksi->bukti_pembayaran = $request->bukti_pembayaran;
            $transaksi->status = $request->status;
            $transaksi->save();
            return response([
                'statusAPI' => true,
                'message' => 'Transaksi berhasil diubah'
            ], 200);
        } else {
            return response([
                'status' => false,
                'message' => 'Data Transaksi tidak ditemukan'
            ], 404);
        }
    }

    public function deleteTransaksi(Request $request, $id)
    {
        $detail_transaksi = Transaksi::where('id', $id)->first();

        if ($detail_transaksi) 
        {
            $transaksi = Transaksi::destroy($id);
            if($transaksi)
            {
                return response([
                    'statusAPI' => true,
                    'message' => 'Transaksi berhasil dihapus'
                ], 200);
            }
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Transaksi tidak ditemukan'
            ], 404);
        }
    }
}
