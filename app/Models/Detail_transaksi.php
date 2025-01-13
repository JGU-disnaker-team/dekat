<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Detail_transaksi extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_transaksi',
        'id_layanan',
        'id_jasa',
        'harga_satuan',
        'status',
        'status_garansi',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa');
    }
}
