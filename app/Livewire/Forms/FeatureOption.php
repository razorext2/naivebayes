<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class FeatureOption extends Form
{
    public ?string $value = '';

    public ?int $order = null;

    public function rules()
    {
        return [
            'value' => 'required',
            'order' => 'required',
        ];
    }
}
