<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klub_id', 'judul_lagu', 'jali_vokal', 'jali_adab', 'jali_banjari', 'khofi_vokal', 'khofi_adab', 'khofi_banjari', 'catatan_vokal', 'catatan_adab', 'catatan_banjari',
    ];

    public function klub()
    {
        return $this->belongsTo(Klub::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
