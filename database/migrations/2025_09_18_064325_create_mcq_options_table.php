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
        Schema::create('mcq_options', function (Blueprint $table) {
            $table->id();
            // foreign key to mcq_questions table
            $table->unsignedBigInteger('mcq_question_id');
            $table->foreign('mcq_question_id')->references('id')->on('mcq_questions')->onDelete('cascade');
            // option text field
            $table->text('option_text');
            // is correct field
            $table->boolean('is_correct')->default(false);
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
        Schema::dropIfExists('mcq_options');
    }
};
