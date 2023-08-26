<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pemagangans()
    {
        return $this->hasMany(Pemagangan::class, 'namapembimbing', 'name');
        return $this->hasMany(Pemagangan::class, 'user_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function programstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'programstudi', 'id');
    }
    
    public function getDataUser()
    {
        $mahasiswa = DB::table('users')
        ->join('pemagangans', 'users.id', '=', 'pemagangans.user_id')
        ->select('pemagangans.nama', 'pemagangans.jurusan','pemagangans.user_id')
        ->where('status_akun', 'DITERIMA')
        ->get();
        return $mahasiswa;
    }
}
