<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Model extends Form
{
    public ?string $name = '';

    public ?string $description = '';

    public ?string $algorithm_type = '';

    public ?bool $is_active = true;

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'algorithm_type' => 'required',
            'is_active' => 'required',
        ];
    }
}
