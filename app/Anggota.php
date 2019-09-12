<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'foto', 'nohp', 'tempat_lahir', 'tanggal_lahir', 'klub_id',
    ];

    public function klub()
    {
        return $this->belongsTo(Klub::class);
    }
}
