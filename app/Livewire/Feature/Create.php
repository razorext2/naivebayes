<?php

namespace App\Livewire\Feature;

use Livewire\Component;

class Create extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\Feature $form;

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // tambah data
            \App\Models\DataMining\Feature::create($this->form->all());

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Fitur berhasil ditambah.',
            ]);

            $this->redirectRoute('feature.index');

        }, 'Gagal menambahkan feature', [
            'user_id' => auth()->id(),
            'action' => 'create feature',
        ]);
    }

    public function render()
    {
        return view('livewire.feature.create');
    }
}
