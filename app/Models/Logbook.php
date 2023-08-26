<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = 'logbook'; // Nama tabel dalam database

    protected $fillable = [
        'user_id',
        'date',
        'name',
        'status_kehadiran',
        'deskripsi_tugas',
        'alasan_ketidakhadiran',
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