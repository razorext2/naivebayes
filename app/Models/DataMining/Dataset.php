<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $fillable = ['model_id', 'name', 'type'];

    public function model()
    {
        return $this->belongsTo(\App\Models\DataMining\Model::class);
    }

    public function records()
    {
        return $this->hasMany(DatasetRecord::class);
    }
}
