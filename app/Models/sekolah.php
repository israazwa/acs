<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sekolah extends Model
{
    //
    protected $table = 'sekolahs';

    // Field yang bisa diisi mass-assignment
    protected $fillable = [
        'nama_sekolah',
        'alamat',
        'kode_unik',
        'admin_id',
        'pengumuman',
    ];
    public function pelajarans()
    {
        return $this->hasMany(Pelajaran::class);
    }
    public function videoPelajarans()
    {
        return $this->hasMany(VideoPelajaran::class);
    }
}
