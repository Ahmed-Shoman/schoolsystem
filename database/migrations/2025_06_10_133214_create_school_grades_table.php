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
        Schema::create('school_grades', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->enum('education_level', ['ماقبل الابتدائي', 'الابتدائي', 'الاعدادي', 'الثانوي العام']);
            $table->enum('dependency', ['رسمي لغات', 'متميز لغات']);
            $table->json('grades')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_grades');
    }
};
