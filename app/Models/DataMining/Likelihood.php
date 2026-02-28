<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class Likelihood extends Model
{
    protected $fillable = [
        'model_id',
        'feature_id',
        'class_label_id',
        'feature_value',
        'total_count',
        'probability',
    ];
}
