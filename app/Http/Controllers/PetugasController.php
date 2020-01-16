<?php

namespace App\Http\Controllers;

use App\Level;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::with('level')->where('id', '!=', Auth::user()->id)->get();
        $level = Level::all();
        return view('contents.petugas.index', compact('petugas', 'level'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|min:5',
            'password' => 'required|min:5',
            'level' => 'required',
            'email' => 'required|unique:users,email'
        ]);
        $petugas = new User();
        $petugas->name = $request->nama_petugas;
        $petugas->email = $request->email;
        $petugas->id_level = $request->level;
        $petugas->password = Hash::make($request->password);
        if ($petugas->save()) {
            return redirect()->route('petugas.index')->with(['message' => 'Data berhasil ditambah', 'message_type' => 'success']);
        } else {
            return redirect()->route('petugas.index')->with(['message' => 'Data gagal ditambah', 'message_type' => 'error']);
        }
    }
    public function find($id)
    {
        return response()->json(User::with('level')->where('id', $id)->first());
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);
        if ($request->ganti_password) {
            $request->validate([
                'nama_petugas' => 'required|min:5',
                'old_password' => 'required|min:5',
                'new_password' => 'required|min:5',
                'level' => 'required',
            ]);
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with(['message' => 'Password lama salah', 'message_type' => 'error']);
            } else {
                $user->password = Hash::make($request->new_password);
            }
        } else {
            $request->validate([
                'nama_petugas' => 'required|min:5',
                'level' => 'required',
            ]);
        }
        $user->name = $request->nama_petugas;
        $user->id_level = $request->level;
        if ($user->save()) {
            return redirect()->route('petugas.index')->with(['message' => 'Data berhasil diedit', 'message_type' => 'success']);
        } else {
            return redirect()->route('petugas.index')->with(['message' => 'Data gagal diedit', 'message_type' => 'error']);
        }
    }
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect()->route('petugas.index')->with(['message' => 'Data berhasil dihapus', 'message_type' => 'success']);
        } else {
            return redirect()->route('petugas.index')->with(['message' => 'Data gagal dihapus', 'message_type' => 'error']);
        }
    }
}
