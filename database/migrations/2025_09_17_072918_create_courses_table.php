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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // audience field with enum values
            $table->enum('audience', ['student', 'tutor']);
            // foreign key to levels table as level_id
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            // title fields
            $table->string('title_ar');
            $table->string('title_en');
            // description fields
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
