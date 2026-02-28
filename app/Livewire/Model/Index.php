<?php

namespace App\Livewire\Model;

use App\Livewire\Concerns\HandlesErrors;
use Livewire\Component;

class Index extends Component
{
    use HandlesErrors, \Livewire\WithPagination;

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
            // cari model
            $data = \App\Models\DataMining\Model::findOrFail($id);

            $data->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Model berhasil dihapus.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus model', [
            'user_id' => auth()->id(),
            'action' => 'delete model',
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function models()
    {
        return \App\Models\DataMining\Model::query()
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.model.index');
    }
}
