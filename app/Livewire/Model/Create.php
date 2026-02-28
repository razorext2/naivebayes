<?php

namespace App\Livewire\Model;

use App\Livewire\Concerns\HandlesErrors;
use App\Livewire\Forms\Model;
use Livewire\Component;

class Create extends Component
{
    use HandlesErrors;

    public Model $form;

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // tambah data
            \App\Models\DataMining\Model::create($this->form->all());

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Model berhasil ditambah.',
            ]);

            $this->redirectRoute('model.index');

        }, 'Gagal menambahkan model', [
            'user_id' => auth()->id(),
            'action' => 'create model',
        ]);
    }

    public function render()
    {
        return view('livewire.model.create');
    }
}
