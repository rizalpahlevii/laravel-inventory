<?php

namespace App\Http\Controllers;

use App\Inventaris;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('detail_pinjam', 'detail_pinjam.inventaris', 'pegawai')->where('status', 'Dipinjam')->get();
        return view('contents.pengembalian.index', compact('peminjaman'));
    }
    public function detail($id)
    {
        $peminjaman = Peminjaman::with('detail_pinjam', 'detail_pinjam.inventaris', 'detail_pinjam.inventaris.jenis', 'detail_pinjam.inventaris.ruang', 'pegawai')->where('id', $id)->first();
        return view('contents.pengembalian.detail', compact('peminjaman'));
    }
    public function kembalikan($id)
    {
        DB::beginTransaction();
        try {
            $peminjaman =  Peminjaman::find($id);
            $peminjaman->status = 'Dikembalikan';
            $pmj = Peminjaman::with('detail_pinjam', 'detail_pinjam.inventaris')->where('id', $id)->first();
            foreach ($pmj->detail_pinjam as $row) {
                $inventaris = Inventaris::find($row->id_inventaris);
                $inventaris->jumlah += $row->jumlah;
                $inventaris->save();
            }
            $peminjaman->save();
            DB::commit();
            return redirect()->route('pengembalian.index')->with(['message' => 'inventaris berhasil dikembalikan', 'message_type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pengembalian.index')->with(['message' => 'inventaris gagal dikembalikan', 'message_type' => 'error']);
        }
    }
}
