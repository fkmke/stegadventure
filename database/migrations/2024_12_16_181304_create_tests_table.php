<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->foreignUuid('participant_id')->constrained()->primary();
            $table->json('question1');
            $table->json('question2');
            $table->json('question3');
            $table->integer('question4');
            $table->integer('question5');
            $table->json('question6');
            $table->json('question7');
            $table->integer('question8');
            $table->integer('question9');
            $table->integer('time_since_start');
            $table->float('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
