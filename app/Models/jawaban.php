<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jawaban extends Model
{
    //
    protected $fillable = [
        'soal_id',
        'teks_jawaban',
        'is_benar',
    ];

    /**
     * Relasi ke Soal
     */
    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
