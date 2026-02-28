<?php

namespace App\Livewire\Dataset;

use Livewire\Component;

class Create extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\Dataset $form;

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // tambah data
            \App\Models\DataMining\Dataset::create($this->form->all());

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Fitur berhasil ditambah.',
            ]);

            $this->redirectRoute('dataset.index');

        }, 'Gagal menambahkan dataset', [
            'user_id' => auth()->id(),
            'action' => 'create dataset',
        ]);
    }

    public function render()
    {
        return view('livewire.dataset.create');
    }
}
