<?php

namespace App\Livewire\Feature;

use App\Livewire\Forms\FeatureOption;
use Livewire\Component;

class Options extends Component
{
    use \App\Livewire\Concerns\HandlesErrors, \Livewire\WithPagination;

    public FeatureOption $form;

    public $sortBy = 'order';

    public $sortDirection = 'asc';

    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function delete($id)
    {
        $this->runSafely(function () use ($id) {
            // cari feature
            $data = \App\Models\DataMining\FeatureOption::findOrFail($id);

            $data->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Opsi fitur berhasil dihapus.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus opsi', [
            'user_id' => auth()->id(),
            'action' => 'delete option',
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function options()
    {
        return \App\Models\DataMining\FeatureOption::query()
            ->where('feature_id', $this->id)
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }

    public function store()
    {
        $this->form->validate();

        $this->runSafely(function () {
            // tambah data
            \App\Models\DataMining\FeatureOption::create([
                'feature_id' => $this->id,
                'value' => $this->form->value,
                'order' => $this->form->order,
            ]);

            // refresh
            $this->form->reset();
            $this->dispatch('$refresh');

            // dispatch swal
            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Opsi fitur berhasil ditambah.',
            ]);
        }, 'Gagal menambah opsi fitur', [
            'user_id' => auth()->id(),
            'action' => 'create feature',
        ]);
    }

    public function render()
    {
        return view('livewire.feature.options');
    }
}
