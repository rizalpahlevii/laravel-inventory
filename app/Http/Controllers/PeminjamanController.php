<?php

namespace App\Http\Controllers;

use App\Detail_pinjam;
use App\Inventaris;
use App\Pegawai;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::orderBy('id', 'DESC')->first();
        if ($peminjaman) {
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
        if ($peminjaman) {
            $getLatestPeminjamanId = $peminjaman->id + 1;
        } else {
            $getLatestPeminjamanId = 1;
        }

        DB::beginTransaction();
        try {
            $inventaris = Inventaris::find($request->id_inventaris);
            $detail = new Detail_pinjam();
            $detail->id_peminjaman = $getLatestPeminjamanId;
            $detail->id_inventaris = $request->id_inventaris;
            $detail->jumlah = $request->jumlah_pinjam;
            $detail->kondisi = $inventaris->kondisi;
            $detail->status = $request->status_detail;
            $detail->save();
            $inventaris->jumlah -= $request->jumlah_pinjam;
            $inventaris->save();
            DB::commit();
            $status = "berhasil";
        } catch (\Exception $e) {
            DB::rollBack();
            $status = "gagal";
        }
        return response()->json($status);
    }
    public function destroy($id)
    {
        $detail = Detail_pinjam::find($id);
        $inventaris = Inventaris::find($detail->id_inventaris);
        $jumlah = $detail->jumlah;
        if ($detail->delete()) {
            $inventaris->jumlah += $jumlah;
            $inventaris->save();
            $status = "berhasil";
        } else {
            $status = "gagal";
        }
        return response()->json($status);
    }
    public function storePinjam(Request $request)
    {
        DB::beginTransaction();
        try {
            $peminjaman = new Peminjaman();
            $peminjaman->kode_peminjaman = $request->kode_peminjaman;
            $peminjaman->tanggal_pinjam = date('Y-m-d');
            $peminjaman->tanggal_kembali = $request->tanggal_kembali;
            $peminjaman->status = 'Dipinjam';
            $peminjaman->id_pegawai = $request->id_pegawai;
            $peminjaman->save();
            DB::commit();
            $status = "berhasil";
        } catch (\Exception $e) {
            DB::rollBack();
            $status = "gagal";
        }
        return response()->json($status);
    }
}
