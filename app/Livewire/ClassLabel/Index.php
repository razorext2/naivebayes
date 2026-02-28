<?php

namespace App\Livewire\ClassLabel;

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
            // cari class
            $data = \App\Models\DataMining\ClassLabel::findOrFail($id);

            $data->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Class berhasil dihapus.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus Class', [
            'user_id' => auth()->id(),
            'action' => 'delete class',
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function classLabels()
    {
        return \App\Models\DataMining\ClassLabel::query()
            ->with('model')
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.class-label.index');
    }
}
