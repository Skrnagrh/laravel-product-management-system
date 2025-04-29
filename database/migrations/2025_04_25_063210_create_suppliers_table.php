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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); // Nama perusahaan / supplier
            $table->string('contact_person')->nullable(); // Nama orang yang bisa dihubungi
            $table->string('email')->nullable(); // Email supplier
            $table->string('phone')->nullable(); // Nomor telepon
            $table->text('address')->nullable(); // Alamat lengkap
            $table->string('city')->nullable(); // Kota
            $table->string('province')->nullable(); // Provinsi
            $table->string('country')->default('Indonesia'); // Negara (default Indonesia)
            $table->json('contact_info')->nullable(); // Info tambahan dalam format JSON kalau perlu (misal multiple contacts)
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps();
            $table->softDeletes(); // Untuk soft delete
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
