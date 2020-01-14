<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('contents.pegawai.index', compact('pegawai'));
    }
    public function store(Request $request)
    {
        $pegawai = new Pegawai();
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->alamat = $request->alamat;
        $pegawai->nip = $request->nip;
        $pegawai->kode_pegawai = $request->kode_pegawai;
        if ($pegawai->save()) {
            return redirect()->route('pegawai.index')->with(['message' => 'Data berhasil ditambah', 'message_type' => 'success']);
        } else {
            return redirect()->route('pegawai.index')->with(['message' => 'Data gagal ditambah', 'message_type' => 'error']);
        }
    }
    public function find($id)
    {
        return response()->json(Pegawai::find($id));
    }
    public function update(Request $request)
    {
        $pegawai = Pegawai::find($request->id);
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->alamat = $request->alamat;
        $pegawai->nip = $request->nip;
        $pegawai->kode_pegawai = $request->kode_pegawai;
        if ($pegawai->save()) {
            return redirect()->route('pegawai.index')->with(['message' => 'Data berhasil diedit', 'message_type' => 'success']);
        } else {
            return redirect()->route('pegawai.index')->with(['message' => 'Data gagal diedit', 'message_type' => 'error']);
        }
    }
    public function delete($id)
    {
        $pegawai = Pegawai::find($id);
        if ($pegawai->delete()) {
            return redirect()->route('pegawai.index')->with(['message' => 'Data berhasil dihapus', 'message_type' => 'success']);
        } else {
            return redirect()->route('pegawai.index')->with(['message' => 'Data gagal dihapus', 'message_type' => 'error']);
        }
    }
}
