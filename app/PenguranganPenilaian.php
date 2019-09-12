<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenguranganPenilaian extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'klub_id', 'jenis', 'jumlah',
    ];

    public function klub()
    {
        return $this->belongsTo(Klub::class);
    }
}
