<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = 'bimbingan'; // Nama tabel dalam database

    protected $guarded = [
        'id',
        // 'user_id',
        // 'date',
        // 'status_kehadiran',
        // 'deskripsi_tugas',
        // 'alasan_ketidakhadiran',
    ];

    // Relasi dengan model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function pemagangan()
    {
        return $this->belongsTo(Pemagangan::class, 'pemagangan_id');
    }
}