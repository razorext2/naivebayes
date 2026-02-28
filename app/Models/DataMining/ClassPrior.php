<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class ClassPrior extends Model
{
    protected $fillable = [
        'model_id',
        'class_label_id',
        'total_count',
        'probability',
    ];
}
