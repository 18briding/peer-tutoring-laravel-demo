<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutoring_requests', function (Blueprint $table) {
            $table->id();
            $table->string('course');
            $table->text('reason');
            $table->json('topics');
            $table->date('preferred_date');
            $table->string('preferred_time');
            $table->string('status')->default('Pending review');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutoring_requests');
    }
};