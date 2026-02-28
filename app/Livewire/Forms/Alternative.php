<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class Alternative extends Form
{
    public ?string $name = '';

    public ?string $class = '';

    public ?string $nidn = '';

    public ?array $data = [];

    public function rules()
    {
        return [
            'name' => 'required',
            'class' => 'required',
            'nidn' => 'required',
            'data' => 'array',
        ];
    }
}
