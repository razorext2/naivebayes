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
        Schema::create('class_priors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('class_label_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('total_count');
            $table->double('probability', 15, 10);
            $table->timestamps();

            $table->unique(['model_id', 'class_label_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_priors');
    }
};
