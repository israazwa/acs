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
        Schema::create('pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelajaran');
            $table->text('deskripsi')->nullable();
            $table->foreignId('sekolah_id')->constrained('sekolahs')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('pelajarans')->insert([
            'nama_pelajaran' => 'Umum',
            'deskripsi' => 'Pelajaran umum default',
            'sekolah_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        DB::table('pelajarans')->insert([
            'nama_pelajaran' => 'Matematika',
            'deskripsi' => 'Pelajaran Matematika',
            'sekolah_id' => 1,
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
