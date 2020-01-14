<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\Jenis;
use App\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventarisController extends Controller
{
    public function index()
    {
        $ruang = Ruang::all();
        $jenis = Jenis::all();
        $inventaris = Inventaris::with('ruang', 'jenis', 'petugas')->get();
        return view('contents.inventaris.index', compact('ruang', 'jenis', 'inventaris'));
    }
    public function store(Request $request)
    {
        $inventaris = new Inventaris();
        $inventaris->nama = $request->nama;
        $inventaris->kondisi = $request->kondisi;
        $inventaris->jumlah = (int) $request->jumlah;
        $inventaris->id_jenis = $request->jenis;
        $inventaris->tanggal_register = $request->tanggal_register;
        $inventaris->id_ruang = $request->ruang;
        $inventaris->kode_inventaris = $request->kode_inventaris;
        $inventaris->id_petugas = Auth::user()->id;
        $inventaris->keterangan = $request->keterangan;
        if ($inventaris->save()) {
            $status = "berhasil";
        } else {
            $status = "gagal";
        }
        return response()->json($status);
    }
}
