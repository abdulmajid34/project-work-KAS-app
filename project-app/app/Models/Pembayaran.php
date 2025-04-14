<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';
    protected $fillable = ['tanggal_pembayaran', 'jumlah', 'siswa_id', 'status_pembayaran', 'deskripsi'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
