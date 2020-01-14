<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    public function jenis()
    {
        return $this->hasOne(Jenis::class, 'id', 'id_jenis');
    }
    public function petugas()
    {
        return $this->hasOne(User::class, 'id', 'id_petugas');
    }
    public function ruang()
    {
        return $this->hasOne(Ruang::class, 'id', 'id_ruang');
    }
}
