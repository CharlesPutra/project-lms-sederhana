<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {
            $table->id();
            // Relasi ke tugas
            $table->foreignId('tugas_id')->constrained('tugas')->cascadeOnDelete();
            // Relasi ke siswa (users role siswa)
            $table->foreignId('siswa_id')->constrained('users')->cascadeOnDelete();
            // File jawaban siswa
            $table->string('file');
            // Nilai dari guru (opsional)
            $table->integer('nilai')->nullable();
            // Catatan guru (opsional)
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};
