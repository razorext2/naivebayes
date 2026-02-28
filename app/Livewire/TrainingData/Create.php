<?php

namespace App\Livewire\TrainingData;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Alternative;
use App\Models\DataMining\Dataset;
use Livewire\Component;

class Create extends Component
{
    use HandlesErrors;

    public Alternative $form;

    public Dataset $dataset;

    public $features;

    public $class_label_id;

    public array $values = [];

    public function mount($id)
    {
        $this->dataset = Dataset::findOrFail($id);

        $this->features = $this->dataset->model->features;

        foreach ($this->features as $feature) {
            $this->values[$feature->id] = null;
        }
    }

    public function render()
    {
        return view('livewire.training-data.create');
    }
}
