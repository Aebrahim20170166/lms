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
        Schema::create('submission_files', function (Blueprint $table) {
            $table->id();
            // foreign key to project_submissions table
            $table->unsignedBigInteger('project_submission_id');
            $table->foreign('project_submission_id')->references('id')->on('project_submissions')->onDelete('cascade');
            // file path field 
            $table->string('file_path');
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
        Schema::dropIfExists('submission_files');
    }
};
