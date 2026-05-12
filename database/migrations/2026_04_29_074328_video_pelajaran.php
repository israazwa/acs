<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelajaran_id')->constrained('pelajarans')->onDelete('cascade');
            $table->string('judul_video'); // contoh: "Bab 1 - Persamaan Linear"
            $table->string('streaming_url')->nullable(); // link streaming (Zoom, YouTube Live, dll)
            $table->string('recorded_path')->nullable(); // path file rekaman setelah streaming
            $table->text('deskripsi')->nullable(); // deskripsi singkat video
            $table->timestamps();
        });

        DB::table('video_pelajarans')->insert([
            'pelajaran_id' => 1, // pastikan pelajaran dengan id=1 sudah ada
            'judul_video' => 'Video Default',
            'streaming_url' => 'example urls streaming',
            'recorded_path' => 'example path recorded',
            'deskripsi' => 'Video pelajaran default yang dibuat saat migrasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::create('chat_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('video_pelajaran_id')->constrained('video_pelajarans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('pesan');
            $table->boolean('is_pinned')->default(false); // untuk pesan yang dipin
            $table->string('role_pengirim')->default('siswa'); // identifikasi pengirim
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
