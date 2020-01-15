<?php

namespace App\Http\Controllers;

use App\Detail_pinjam;
use App\Inventaris;
use App\Pegawai;
use App\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('id', 'DESC')->first();
        if ($peminjaman->count() > 0) {
            $getLatestPeminjamanId = $peminjaman->id + 1;
        } else {
            $getLatestPeminjamanId = 1;
        }
        $kode = Peminjaman::kode_peminjaman();
        $pegawai = Pegawai::all();
        $inventaris = Inventaris::with('ruang', 'jenis', 'petugas')->get();
        $detail_pinjam = Detail_pinjam::with('inventaris')->where('id_peminjaman', $getLatestPeminjamanId)->get();
        return view('contents.peminjaman.index', compact('inventaris', 'pegawai', 'kode', 'detail_pinjam'));
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
    public function storeDetail(Request $request)
    {
        $peminjaman = Peminjaman::orderBy('id', 'DESC')->first();
        if ($peminjaman->count() > 0) {
            $getLatestPeminjamanId = $peminjaman->id + 1;
        } else {
            $getLatestPeminjamanId = 1;
        }


        $inventaris = Inventaris::find($request->id_inventaris);
        $detail = new Detail_pinjam();

        $detail->id_peminjaman = $getLatestPeminjamanId;
        $detail->id_inventaris = $request->id_inventaris;
        $detail->jumlah = $request->jumlah_pinjam;
        $detail->kondisi = $inventaris->kondisi;
        $detail->status = $request->status_detail;
        if ($detail->save()) {
            $response = "berhasil";
        } else {
            $response = "gagal";
        }
        return response()->json($response);
    }
    public function destroy($id)
    {
        $detail = Detail_pinjam::find($id);
        if ($detail->delete()) {
            $status = "berhasil";
        } else {
            $status = "gagal";
        }
        return response()->json($status);
    }
}
