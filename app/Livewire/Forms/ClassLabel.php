<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ClassLabel extends Form
{
    public ?string $model_id = '';

    public ?string $name = '';

    public function rules()
    {
        return [
            'model_id' => 'required',
            'name' => 'required',
        ];
    }
}
