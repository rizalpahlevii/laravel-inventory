<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\Pegawai;
use App\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $kode = Peminjaman::kode_peminjaman();
        $pegawai = Pegawai::all();
        $inventaris = Inventaris::with('ruang', 'jenis', 'petugas')->get();
        return view('contents.peminjaman.index', compact('inventaris', 'pegawai', 'kode'));
    }
    public function findInventaris($id)
    {
        $inventaris = Inventaris::with('ruang', 'jenis', 'petugas')->where('id', $id)->first();
        return response()->json($inventaris);
    }
    public function findPegawai($id)
    {
        return response()->json(Pegawai::find($id));
    }
}
