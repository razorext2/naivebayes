<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $fillable = [
        'dataset_record_id',
        'feature_id',
        'value',
    ];

    public function record()
    {
        return $this->belongsTo(DatasetRecord::class, 'dataset_record_id');
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
