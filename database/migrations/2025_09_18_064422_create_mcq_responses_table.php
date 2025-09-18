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
        Schema::create('mcq_responses', function (Blueprint $table) {
            $table->id();
            // foreign key to mcq_questions table
            $table->unsignedBigInteger('mcq_question_id');
            $table->foreign('mcq_question_id')->references('id')->on('mcq_questions')->onDelete('cascade');
            // foreign key to mcq_options table
            $table->unsignedBigInteger('selected_option_id');
            $table->foreign('selected_option_id')->references('id')->on('mcq_options')->onDelete('cascade');
            // foreign key to students table
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            // answered at field
            $table->timestamp('answered_at')->useCurrent();
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
        Schema::dropIfExists('mcq_responses');
    }
};
