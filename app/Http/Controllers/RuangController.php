<?php

namespace App\Http\Controllers;

use App\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruang = Ruang::all();
        return view('contents.ruang.index', compact('ruang'));
    }
    public function store(Request $request)
    {
        $ruang = new Ruang();
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->kode_ruang = $request->kode_ruang;
        $ruang->keterangan = $request->keterangan;
        if ($ruang->save()) {
            return redirect()->route('ruang.index')->with(['message' => 'Data berhasil ditambah', 'message_type' => 'success']);
        } else {
            return redirect()->route('ruang.index')->with(['message' => 'Data gagal ditambah', 'message_type' => 'error']);
        }
    }
    public function find($id)
    {
        return response()->json(Ruang::find($id));
    }
    public function update(Request $request)
    {
        $ruang = Ruang::find($request->id);
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->kode_ruang = $request->kode_ruang;
        $ruang->keterangan = $request->keterangan;
        if ($ruang->save()) {
            return redirect()->route('ruang.index')->with(['message' => 'Data berhasil diedit', 'message_type' => 'success']);
        } else {
            return redirect()->route('ruang.index')->with(['message' => 'Data gagal diedit', 'message_type' => 'error']);
        }
    }
    public function delete($id)
    {
        $ruang = Ruang::find($id);
        if ($ruang->delete()) {
            return redirect()->route('ruang.index')->with(['message' => 'Data berhasil dihapus', 'message_type' => 'success']);
        } else {
            return redirect()->route('ruang.index')->with(['message' => 'Data gagal dihapus', 'message_type' => 'error']);
        }
    }
}
