<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jawabanSiswa extends Model
{
    //
    protected $fillable = [
        'user_id',
        'soal_id',
        'jawaban',
        'is_benar',
        'jawaban_id',
        'skor'
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
