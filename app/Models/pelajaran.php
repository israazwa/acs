<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelajaran extends Model
{
    protected $table = 'pelajarans';

    // Field yang bisa diisi mass-assignment
    protected $fillable = [
        'nama_pelajaran',
        'deskripsi',
        'sekolah_id',
    ];

    public function videoPelajarans()
    {
        return $this->hasMany(VideoPelajaran::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
