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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            // foreign key to courses table as course_id
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // title fields
            $table->string('title');
            // description fields
            $table->text('description')->nullable();
            // order no field
            $table->integer('order_no')->default(0);
            // duration field in minutes
            $table->integer('duration')->default(0);
            // is_active field
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('lessons');
    }
};
