<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class videoPelajaran extends Model
{
    use HasFactory;
    protected $table = 'video_pelajarans';

    protected $fillable = [
        'pelajaran_id',
        'judul_video',
        'streaming_url',
        'recorded_path',
        'deskripsi',
    ];

    // Relasi ke Pelajaran
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class);
    }

    // Relasi ke ChatVideo
    public function chatVideos()
    {
        return $this->hasMany(chatVideo::class);
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
