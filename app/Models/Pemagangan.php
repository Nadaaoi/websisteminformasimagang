<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Pemagangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    // Dalam model Pemagangan.php
    protected $table = 'Pemagangans';

    // protected $table = 'pemagangan';    
    public function user()
    {
        return $this->belongsTo(User::class);
        return $this->belongsTo(User::class, 'namapembimbing', 'name');
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
    public function pembimbing()
    {
        return $this->belongsTo(User::class, 'id_pembimbing', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function laporanAkhir()
    {
        return $this->hasOne(LaporanAkhir::class, 'user_id');
    }
}
