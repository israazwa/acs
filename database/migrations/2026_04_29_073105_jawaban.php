<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('soals')->onDelete('cascade');
            $table->string('teks_jawaban');
            $table->boolean('is_benar')->default(false);
            $table->timestamps();
        });


        Schema::create('jawaban_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('soals')->onDelete('cascade');
            $table->foreignId('jawaban_id')->nullable()->constrained('jawabans')->onDelete('set null');
            $table->text('jawaban'); // isi jawaban siswa (misalnya essay)
            $table->boolean('is_benar')->nullable();
            $table->integer('skor')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'soal_id']); // satu siswa hanya boleh punya satu jawaban per soal
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
