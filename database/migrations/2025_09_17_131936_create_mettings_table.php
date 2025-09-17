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
        Schema::create('mettings', function (Blueprint $table) {
            $table->id();
            // foreign key to enrollments table
            $table->unsignedBigInteger('enrollment_id');
            $table->foreign('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade');
            // zoom link field
            $table->string('zoom_link');
            // start_at datetime field
            $table->dateTime('start_at');
            // end_at datetime field
            $table->dateTime('end_at');
            // tutor_joined_at datetime field
            $table->dateTime('tutor_joined_at')->nullable();
            // student_joined_at datetime field
            $table->dateTime('student_joined_at')->nullable();
            // soft deletes
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mettings');
    }
};
