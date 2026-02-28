<?php

namespace App\Livewire\ClassLabel;

use Livewire\Component;

class Edit extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\ClassLabel $form;

    public \App\Models\DataMining\ClassLabel $model;

    public $id;

    public function mount($id)
    {
        $this->id = $id;

        $this->model = \App\Models\DataMining\ClassLabel::findOrFail($id);

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
                'text' => 'Class berhasil diubah.',
            ]);

            $this->redirect(route('class-label.index'));
        }, 'Gagal mengubah Class', [
            'user_id' => auth()->id(),
            'action' => 'update class-label',
        ]);
    }

    public function render()
    {
        return view('livewire.class-label.edit');
    }
}
