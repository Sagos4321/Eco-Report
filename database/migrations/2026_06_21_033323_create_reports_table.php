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
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        // Tambahkan ->nullable() agar sistem mengizinkan kolom ini kosong
        $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
        $table->string('title');
        $table->text('description');
        $table->string('location');
        $table->string('image_path')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->integer('likes')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
