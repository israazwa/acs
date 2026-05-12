<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class requestAdmin extends Model
{
    //
    use HasFactory;
    protected $table = 'request_admins';

    // Field yang bisa diisi mass-assignment
    protected $fillable = [
        'name',
        'email',
        'password',
        'sekolah',
        'alamat',
        'kode_unik',
        'ktp_path',
        'status_permintaan',
        'catatan',
    ];
}
