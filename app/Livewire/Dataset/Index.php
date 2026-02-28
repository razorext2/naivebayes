<?php

namespace App\Livewire\Dataset;

use Livewire\Component;

class Index extends Component
{
    use \App\Livewire\Concerns\HandlesErrors, \Livewire\WithPagination;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

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
            $data = \App\Models\DataMining\Dataset::findOrFail($id);

            $data->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Dataset berhasil dihapus.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus Dataset', [
            'user_id' => auth()->id(),
            'action' => 'delete dataset',
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function datasets()
    {
        return \App\Models\DataMining\Dataset::query()
            ->with('model')
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.dataset.index');
    }
}
