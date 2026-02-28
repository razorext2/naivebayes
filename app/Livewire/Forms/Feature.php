<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Feature extends Form
{
    public ?string $model_id = '';

    public ?string $name = '';

    public ?string $type = 'categorical';

    public function rules()
    {
        return [
            'model_id' => 'required',
            'name' => 'required',
            'type' => 'required',
        ];
    }
}
