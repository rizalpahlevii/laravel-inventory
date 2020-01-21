<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $years = Peminjaman::select(DB::raw('YEAR(created_at) as year'))->distinct()->get();
        $laporan = Peminjaman::with('detail_pinjam', 'pegawai', 'detail_pinjam.inventaris', 'detail_pinjam.inventaris.ruang', 'detail_pinjam.inventaris.jenis')->where('status', 'Dikembalikan');
        if (isset($_GET['bulan'])) {
            $laporan->whereMonth('created_at', $_GET['bulan']);
        }
        if (isset($_GET['tahun'])) {
            $laporan->whereYear('created_at', $_GET['tahun']);
        }
        $laporan = $laporan->get();
        return view('contents.laporan.index', compact('laporan', 'years'));
    }
}
