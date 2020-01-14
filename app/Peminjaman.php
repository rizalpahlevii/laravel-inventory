<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    public static function kode_peminjaman()
    {
        $cek = Peminjaman::all();
        if ($cek->count() > 0) {
            $peminjaman = Peminjaman::orderBy('id', 'DESC')->first();
            $nourut = (int) substr($peminjaman->kode_peminjaman, -7, 7);
            $nourut++;
            $char = "PMJ";
            $number = $char  .  sprintf("%07s", $nourut);
        } else {
            $number = "PMJ"  . "0000001";
        }
        return $number;
    }
}
