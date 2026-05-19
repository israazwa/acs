<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class hasilTest extends Model
{
    //
    protected $fillable = [
        'user_id',
        'pelajaran_id',
        'nilai',
        'status_kelulusan',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Pelajaran
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }
}
