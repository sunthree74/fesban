<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPack extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo', 'snack', 'registrasi', 'nomor_urut', 'klub_id', 'mp3_record', 'status',
    ];

    public function klub()
    {
        return $this->belongsTo(Klub::class, 'klub_id');
    }
}
