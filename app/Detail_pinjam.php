<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_pinjam extends Model
{
    protected $table = 'detail_pinjam';
    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris', 'id');
    }
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id');
    }
}
