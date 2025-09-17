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
        Schema::create('tutor_course_progress', function (Blueprint $table) {
            $table->id();
            // foreign key to tutors table
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            // foreign key to courses table
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // status field as enum (not_started, in_progress, completed)
            $table->enum('status', ['not_started', 'in_progress', 'completed'])->default('not_started');
            // score field as float
            $table->float('score')->default(0);
            // completed_at field as nullable timestamp
            $table->timestamp('completed_at')->nullable();
            // valid until field as nullable timestamp
            $table->timestamp('valid_until')->nullable();
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
        Schema::dropIfExists('tutor_course_progress');
    }
};
