<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['model_id', 'name', 'type'];

    public function model()
    {
        return $this->belongsTo(\App\Models\DataMining\Model::class);
    }

    public function values()
    {
        return $this->hasMany(FeatureValue::class);
    }

    public function options()
    {
        return $this->hasMany(FeatureOption::class);
    }
}
