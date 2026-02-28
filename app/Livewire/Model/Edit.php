<?php

namespace App\Livewire\Model;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Model as ModelForm;
use App\Models\DataMining\Model;
use Livewire\Component;

class Edit extends Component
{
    use HandlesErrors;

    public ModelForm $form;

    public Model $model;

    public $id;

    public function mount($id)
    {
        $this->id = $id;

        $this->model = Model::findOrFail($id);

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
                'text' => 'Model berhasil diubah.',
            ]);

            $this->redirect(route('model.index'));
        }, 'Gagal mengubah model', [
            'user_id' => auth()->id(),
            'action' => 'update model',
        ]);
    }

    public function render()
    {
        return view('livewire.model.edit');
    }
}
