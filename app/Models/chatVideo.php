<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class chatVideo extends Model
{
    //
    use HasFactory;

    protected $table = 'chat_videos';

    protected $fillable = [
        'video_pelajaran_id',
        'user_id',
        'pesan',
        'is_pinned',
        'role_pengirim',
    ];

    // Relasi ke VideoPelajaran
    public function videoPelajaran()
    {
        return $this->belongsTo(VideoPelajaran::class);
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
