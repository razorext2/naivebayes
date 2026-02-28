<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'model_id',
        'input_data',
        'predicted_class_id',
        'probability',
    ];

    protected $casts = [
        'input_data' => 'array',
    ];
}
