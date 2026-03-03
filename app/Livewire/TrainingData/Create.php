<?php

namespace App\Livewire\TrainingData;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Alternative;
use App\Models\DataMining\Dataset;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    use HandlesErrors;

    public Alternative $form;

    public Dataset $dataset;

    public $features;

    public ?int $class_label_id = null;

    public ?string $id = '';

    public array $values = [];

    public function mount($id)
    {
        $this->id = $id;

        $this->dataset = Dataset::findOrFail($this->id);

        $this->features = $this->dataset->model->features;

        foreach ($this->features as $feature) {
            $this->values[$feature->id] = null;
        }
    }

    public function store()
    {
        // validasi form
        $this->form->validate();

        // simpan data
        $this->runSafely(function () {
            // inisialisasi data
            $data = [
                'class' => $this->form->class,
                'nidn' => $this->form->nidn,
            ];

            // pake db:transaction
            DB::transaction(function () use ($data) {
                // simpan data
                $alternative = \App\Models\Alternative::create([
                    'name' => $this->form->name,
                    'data' => $data,
                ]);

                $record = $this->dataset->records()->create([
                    'dataset_id' => $this->dataset->id,
                    'alternative_id' => $alternative->id,
                    'class_label_id' => $this->class_label_id,
                ]);

                foreach ($this->values as $featureId => $value) {
                    $record->featureValues()->create([
                        'dataset_record_id' => $record->id,
                        'feature_id' => $featureId,
                        'value' => $value,
                    ]);
                }
            });

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Data training berhasil ditambahkan.',
            ]);

            $this->redirectRoute('dataset.training-data.index', ['dataset' => $this->dataset->id]);
        }, 'Gagal menambahkan data training', [
            'user_id' => auth()->id(),
            'action' => 'create training data',
        ]);
    }

    public function render()
    {
        return view('livewire.training-data.create');
    }
}
