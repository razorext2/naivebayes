<?php

namespace App\Livewire\Feature;

use Livewire\Component;

class Edit extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\Feature $form;

    public \App\Models\DataMining\Feature $model;

    public $id;

    public function mount($id)
    {
        $this->id = $id;

        $this->model = \App\Models\DataMining\Feature::findOrFail($id);

        $this->form->fill($this->model->toArray());
    }

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            $this->model->update($this->form->all());

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Fitur berhasil diubah.',
            ]);

            $this->redirect(route('feature.index'));
        }, 'Gagal mengubah fitur', [
            'user_id' => auth()->id(),
            'action' => 'update fitur',
        ]);
    }

    public function render()
    {
        return view('livewire.feature.edit');
    }
}
