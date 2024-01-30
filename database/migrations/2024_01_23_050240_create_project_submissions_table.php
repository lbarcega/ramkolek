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
            $table->string('title');
            $table->string('abstract');
            $table->string('categories')->nullable();
            $table->string('subject');
            $table->string('professor');
            $table->string('proofreader')->nullable();
            $table->string('attachments')->nullable();
            $table->string('attachments_names')->nullable();
            $table->string('team');
            $table->string('academic_year');
            $table->string('term');
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
