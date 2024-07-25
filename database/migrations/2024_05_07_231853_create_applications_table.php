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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('resume');
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['received', 'reviewed', 'shortlisted'])->default('received');
            $table->string('message')->nullable();
            $table->string('candidate_name')->nullable();
            $table->string('candidate_email')->nullable();
            $table->string('candidate_phone'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
