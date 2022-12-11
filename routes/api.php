<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/film', 'FilmController@getAllFilm');
Route::get('/film/{id}/detail', 'FilmController@getDetailFilm');
Route::post('/film/tambah', 'FilmController@insertFilm');
Route::put('/film/{id}/update', 'FilmController@updateFilm');
Route::delete('/film/{id}/delete', 'FilmController@deleteFilm');

Route::get('/jadwal', 'JadwalController@getAllJadwal');
Route::get('/jadwal/{id}/detail', 'JadwalController@getDetailJadwal');
Route::post('/jadwal/tambah', 'JadwalController@insertJadwal');
Route::put('/jadwal/{id}/update', 'JadwalController@updateJadwal');
Route::delete('/jadwal/{id}/delete', 'JadwalController@deleteJadwal');

Route::get('/kursi', 'KursiController@getAllKursi');
Route::get('/kursi/{id}/detail', 'KursiController@getDetailKursi');
Route::post('/kursi/tambah', 'KursiController@insertKursi');
Route::put('/kursi/{id}/update', 'KursiController@updateKursi');
Route::delete('/kursi/{id}/delete', 'KursiController@deleteKursi');

Route::get('/teater', 'TeaterController@getAllTeater');
Route::get('/teater/{id}/detail', 'TeaterController@getDetailTeater');
Route::post('/teater/tambah', 'TeaterController@insertTeater');
Route::put('/teater/{id}/update', 'TeaterController@updateTeater');
Route::delete('/teater/{id}/delete', 'TeaterController@deleteTeater');

Route::get('/transaksi', 'TransaksiController@getAllTransaksi');
Route::get('/transaksi/{id}/detail', 'TransaksiController@getDetailTransaksi');
Route::post('/transaksi/tambah', 'TransaksiController@insertTransaksi');
Route::put('/transaksi/{id}/update', 'TransaksiController@updateTransaksi');
Route::delete('/transaksi/{id}/delete', 'TransaksiController@deleteTransaksi');
