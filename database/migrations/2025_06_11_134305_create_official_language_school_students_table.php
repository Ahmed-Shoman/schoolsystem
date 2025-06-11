<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('official_language_school_students', function (Blueprint $table) {
            $table->id();
            $table->string('school_name')->nullable(); // إن أردت إضافة اسم المدرسة
            $table->json('stage_data')->nullable(); // Repeater Field
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('official_language_school_students');
    }
};