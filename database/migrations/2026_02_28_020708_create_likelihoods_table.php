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
        Schema::create('likelihoods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('feature_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('class_label_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('feature_value');
            $table->unsignedBigInteger('total_count');
            $table->double('probability', 15, 10);
            $table->timestamps();

            $table->unique(
                ['model_id', 'feature_id', 'class_label_id', 'feature_value'],
                'likelihood_unique'
            );

            $table->index(
                ['model_id', 'feature_id', 'class_label_id'],
                'likelihood_lookup_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likelihoods');
    }
};
