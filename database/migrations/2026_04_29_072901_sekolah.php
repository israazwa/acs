<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        // Tabel Sekolah
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('kode_unik')->unique();
            $table->string('alamat');
            $table->string('pengumuman')->nullable();
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => 'Isra Saqiba',
            'email' => '111202315287@mhs.dinus.ac.id',
            'role' => 'superadmin',
            'password' => Hash::make('1Januari.'),
            'kode_unik' => '12345',
            'sekolah_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('sekolahs')->insert([
            'nama_sekolah' => 'Guest School',
            'alamat' => 'Default Address',
            'admin_id' => 1,
            'pengumuman' => 'lorem ipsum dolor sit amet',
            'kode_unik' => '12345',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
