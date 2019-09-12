<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Klub extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'foto', 'alamat', 'nohp', 'email', 'user_id', 'grup_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }

    public function event_packs()
    {
        return $this->hasMany(EventPack::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function pengurangan_penilaians()
    {
        return $this->hasMany(PenguranganPenilaian::class);
    }
}
