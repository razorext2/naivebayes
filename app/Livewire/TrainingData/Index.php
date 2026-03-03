<?php

namespace App\Livewire\TrainingData;

use Livewire\Component;

class Index extends Component
{
    use \App\Livewire\Concerns\HandlesErrors, \Livewire\WithPagination;

    public $datasetId;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

    public function mount($id)
    {
        $this->datasetId = $id;
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
            // cari record
            $data = \App\Models\Alternative::findOrFail($id);

            $data->delete();

            $this->dispatch('swal', [
                'icon' => 'success',
                'title' => 'Berhasil',
                'text' => 'Alternatif berhasil dihapus.',
            ]);

            $this->dispatch('$refresh');
        }, 'Gagal menghapus Alternatif', [
            'user_id' => auth()->id(),
            'action' => 'delete record',
        ]);
    }

    #[\Livewire\Attributes\Computed]
    public function records()
    {
        return \App\Models\DataMining\DatasetRecord::query()
            ->with('dataset', 'alternative', 'classLabel', 'featureValues')
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->where('dataset_id', $this->datasetId)
            ->paginate(5);
    }

    public function render()
    {
        return view('livewire.training-data.index');
    }
}
