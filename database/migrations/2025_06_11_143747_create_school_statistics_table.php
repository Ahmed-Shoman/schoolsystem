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
        Schema::create('school_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('stage_name');
            $table->string('stage_year');
            $table->integer('schools_count')->default(0);
            $table->integer('total_students')->default(0);
            $table->integer('total_boys')->nullable()->default(0);
            $table->integer('total_girls')->nullable()->default(0);
            $table->integer('total_classrooms')->default(0);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_statistics');
    }
};