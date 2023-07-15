<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pemagangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jenis_program_magang()
    {
        return $this->belongsTo(JenisProgramMagang::class, 'user_id', 'user_id');
    }
    public function penempatan()
    {
        return $this->belongsTo(Penempatan::class, 'user_id', 'user_id');
    }
    public function jadwal_peserta()
    {
        return $this->belongsTo(JadwalPeserta::class, 'user_id', 'user_id');
    }
    public function kebutuhan_magang()
    {
        return $this->belongsTo(KebutuhanMagang::class, 'kebutuhan_id', 'id');
    }
}
