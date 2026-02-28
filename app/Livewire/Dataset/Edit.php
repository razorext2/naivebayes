<?php

namespace App\Livewire\Dataset;

use Livewire\Component;

class Edit extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\Dataset $form;

    public \App\Models\DataMining\Dataset $model;

    public $id;

    public function mount($id)
    {
        $this->id = $id;

        $this->model = \App\Models\DataMining\Dataset::findOrFail($id);

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
                'text' => 'Dataset berhasil diubah.',
            ]);

            $this->redirect(route('dataset.index'));
        }, 'Gagal mengubah dataset', [
            'user_id' => auth()->id(),
            'action' => 'update dataset',
        ]);
    }

    public function render()
    {
        return view('livewire.dataset.edit');
    }
}
