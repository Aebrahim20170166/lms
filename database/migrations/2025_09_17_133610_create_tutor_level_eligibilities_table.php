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
        Schema::create('tutor_level_eligibilities', function (Blueprint $table) {
            $table->id();
            // foreign key to tutors table
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors')->onDelete('cascade');
            // foreign key to levels table
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            // eligible field
            $table->boolean('eligible')->default(false);
            // granted by field as foreign key to admins table
            $table->unsignedBigInteger('granted_by')->nullable();
            $table->foreign('granted_by')->references('id')->on('users')->onDelete('set null');
            // granted_at field
            $table->timestamp('granted_at')->nullable();
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
        Schema::dropIfExists('tutor_level_eligibilities');
    }
};
