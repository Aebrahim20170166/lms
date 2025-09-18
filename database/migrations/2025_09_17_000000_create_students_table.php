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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // foreign key to users table
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // foreign key to levels table
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            // birthdate field
            $table->date('birthdate');
            // school field
            $table->string('school');
            // foreign key to cities table
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            // foreign key to countries table
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            // state field
            $table->string('state');
            // parent contact field
            $table->string('parent_contact');
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
        Schema::dropIfExists('students');
    }
};
