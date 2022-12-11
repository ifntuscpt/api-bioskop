<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Film;
use Exception;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFilm()
    {
        return response()->json(Film::all(), 200);
    }

    public function getDetailFilm($id)
    {
        $film = Film::where('id', $id)->get();
        if (!$film->isEmpty()) {
            return response()->json($film, 200);
        } else {
            return response([
                'message' => 'Film tidak ditemukan'
            ], 404);
        }   
    }

    public function insertFilm(Request $request)
    {
        try {
            $film = new Film;
            $film->judul = $request->judul;
            $film->deskripsi = $request->deskripsi;
            $film->rating = $request->rating;
            $film->produksi = $request->produksi;
            $film->distributor = $request->distributor;
            $film->durasi = $request->durasi;
            $film->country = $request->country;
            $film->save();
            
            return response([
                'statusAPI' => true,
                'message' => 'Film berhasil ditambah'
            ], 200);
        } catch (Exception $e) {
            return response([
                'statusAPI' => false,
                'message' => 'Film gagal ditambah'
            ], 404);
        }
    }

    public function updateFilm(Request $request, $id)
    {
        $detail_film = Film::where('id', $id)->first();

        if ($detail_film) 
        {
            $film = Film::find($id);
            $film->judul = $request->judul;
            $film->deskripsi = $request->deskripsi;
            $film->rating = $request->rating;
            $film->produksi = $request->produksi;
            $film->distributor = $request->distributor;
            $film->durasi = $request->durasi;
            $film->country = $request->country;
            $film->save();
            return response([
                'statusAPI' => true,
                'message' => 'Film berhasil diubah'
            ], 200);
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Film tidak ditemukan'
            ], 404);
        }
    }

    public function deleteFilm(Request $request, $id)
    {
        $detail_film = Film::where('id', $id)->first();

        if ($detail_film) 
        {
            $film = Film::destroy($id);
            if($film)
            {
                return response([
                    'statusAPI' => true,
                    'message' => 'Film berhasil dihapus'
                ], 200);
            }
        } else {
            return response([
                'statusAPI' => false,
                'message' => 'Data Film tidak ditemukan'
            ], 404);
        }
    }
}
