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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->json('input_data');
            $table->foreignId('predicted_class_id')
                ->constrained('class_labels')
                ->cascadeOnDelete();
            $table->double('probability', 15, 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
