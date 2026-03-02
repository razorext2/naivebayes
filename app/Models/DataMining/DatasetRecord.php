<?php

namespace App\Models\DataMining;

use App\Models\Alternative;
use Illuminate\Database\Eloquent\Model;

class DatasetRecord extends Model
{
    protected $fillable = [
        'dataset_id',
        'alternative_id',
        'class_label_id',
    ];

    public function dataset()
    {
        return $this->belongsTo(Dataset::class);
    }

    public function alternative()
    {
        return $this->belongsTo(Alternative::class);
    }

    public function classLabel()
    {
        return $this->belongsTo(ClassLabel::class);
    }

    public function featureValues()
    {
        return $this->hasMany(FeatureValue::class);
    }
}
