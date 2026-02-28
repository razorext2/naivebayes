<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model as ModelEl;

class Model extends ModelEl
{
    protected $fillable = [
        'name',
        'description',
        'algorithm_type',
        'is_active',
    ];

    public function datasets()
    {
        return $this->hasMany(Dataset::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function classLabels()
    {
        return $this->hasMany(ClassLabel::class);
    }

    public function priors()
    {
        return $this->hasMany(ClassPrior::class);
    }

    public function likelihoods()
    {
        return $this->hasMany(Likelihood::class);
    }
}
