<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    //
    protected $fillable = [
        'pertanyaan',
        'tipe',
        'opsi_jawaban',
        'pelajaran_id',
        'sekolah_id'
    ];

    protected $casts = [
        'opsi_jawaban' => 'array',
    ];

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
    public function jawabans()
    {
        return $this->hasMany(Jawaban::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
