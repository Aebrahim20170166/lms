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
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->id();
            // foreign key to tasks table
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            // foreign key to students table
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            // submission file path field
            $table->string('file_path');
            // status field with enum values: not_submitted, submitted, needs_changes, approved
            $table->enum('status', ['not_submitted', 'submitted', 'needs_changes', 'approved']);
            // grade field with float type and nullable
            $table->float('grade')->nullable();
            // feedback field with text type and nullable
            $table->text('feedback')->nullable();
            // foreign key to tutors table for reviewed_by
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->foreign('reviewed_by')->references('id')->on('tutors')->onDelete('set null');
            // reviewed_at field
            $table->timestamp('reviewed_at')->nullable();
            // attempts count field with default value 0
            $table->unsignedInteger('attempts')->default(0);
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
        Schema::dropIfExists('project_submissions');
    }
};
