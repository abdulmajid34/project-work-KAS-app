<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['tanggal_pembayaran', 'pembayaran_id', 'pemasukan', 'pengeluaran', 'jumlah', 'keterangan', 'catatan'];


    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }
}
