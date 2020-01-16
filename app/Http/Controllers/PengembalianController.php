<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('detail_pinjam', 'detail_pinjam.inventaris', 'pegawai')->get();
        return view('contents.pengembalian.index', compact('peminjaman'));
    }
    public function detail($id)
    {
        $peminjaman = Peminjaman::with('detail_pinjam', 'detail_pinjam.inventaris', 'detail_pinjam.inventaris.jenis', 'detail_pinjam.inventaris.ruang', 'pegawai')->where('id', $id)->first();
        return view('contents.pengembalian.detail', compact('peminjaman'));
    }
}
