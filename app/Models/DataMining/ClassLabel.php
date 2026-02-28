<?php

namespace App\Models\DataMining;

use Illuminate\Database\Eloquent\Model;

class ClassLabel extends Model
{
    protected $fillable = ['model_id', 'name'];

    public function model()
    {
        return $this->belongsTo(\App\Models\DataMining\Model::class);
    }
}
