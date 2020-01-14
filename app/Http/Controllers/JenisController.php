<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::all();
        return view('contents.jenis.index', compact('jenis'));
    }
    public function store(Request $request)
    {
        $jenis = new Jenis();
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->kode_jenis = $request->kode_jenis;
        $jenis->keterangan = $request->keterangan;
        if ($jenis->save()) {
            return redirect()->route('jenis.index')->with(['message' => 'Data berhasil ditambah', 'message_type' => 'success']);
        } else {
            return redirect()->route('jenis.index')->with(['message' => 'Data gagal ditambah', 'message_type' => 'error']);
        }
    }
    public function find($id)
    {
        return response()->json(Jenis::find($id));
    }
    public function update(Request $request)
    {
        $jenis = Jenis::find($request->id);
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->kode_jenis = $request->kode_jenis;
        $jenis->keterangan = $request->keterangan;
        if ($jenis->save()) {
            return redirect()->route('jenis.index')->with(['message' => 'Data berhasil diedit', 'message_type' => 'success']);
        } else {
            return redirect()->route('jenis.index')->with(['message' => 'Data gagal diedit', 'message_type' => 'error']);
        }
    }
    public function delete($id)
    {
        $jenis = Jenis::find($id);
        if ($jenis->delete()) {
            return redirect()->route('jenis.index')->with(['message' => 'Data berhasil dihapus', 'message_type' => 'success']);
        } else {
            return redirect()->route('jenis.index')->with(['message' => 'Data gagal dihapus', 'message_type' => 'error']);
        }
    }
}
