<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class FeatureOption extends Model
{
    protected $fillable = [
        'feature_id',
        'value',
        'order',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
