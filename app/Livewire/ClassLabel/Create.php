<?php

namespace App\Livewire\ClassLabel;

use Livewire\Component;

class Create extends Component
{
    use \App\Livewire\Concerns\HandlesErrors;

    public \App\Livewire\Forms\ClassLabel $form;

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // tambah data
            \App\Models\DataMining\ClassLabel::create($this->form->all());

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Class berhasil ditambah.',
            ]);

            $this->redirectRoute('class-label.index');

        }, 'Gagal menambahkan Class', [
            'user_id' => auth()->id(),
            'action' => 'create class-label',
        ]);
    }

    public function render()
    {
        return view('livewire.class-label.create');
    }
}
