<flux:table :paginate="$this->datasets">
    <flux:table.columns>

        <flux:table.column sortable :sorted="$sortBy === 'model_id'" :direction="$sortDirection"
            wire:click="sort('model_id')">
            Nama Model
        </flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
            wire:click="sort('name')">
            Nama Dataset
        </flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'type'" :direction="$sortDirection"
            wire:click="sort('type')">
            Tipe Dataset
        </flux:table.column>

        <flux:table.column>
            #
        </flux:table.column>

    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->datasets as $row)
            <flux:table.row :key="$row->id">
                <flux:table.cell class="flex items-center gap-3">
                    {{ $row->model->name }}
                </flux:table.cell>

                <flux:table.cell class="whitespace-nowrap">
                    {{ $row->name }}
                </flux:table.cell>

                <flux:table.cell>
                    {{ $row->type }}
                </flux:table.cell>

                <flux:table.cell class="flex gap-x-2">
                    <flux:button size="sm" color="blue" variant="primary" wire:navigate
                        href="{{ route('dataset.training-data.index', ['dataset' => $row->id]) }}" icon="queue-list">
                        Kelola Data
                    </flux:button>

                    <flux:button size="sm" color="blue" variant="primary" wire:navigate
                        href="{{ route('dataset.edit', ['id' => $row->id]) }}" icon="pencil" />

                    <flux:button size="sm" color="red"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                        wire:click="delete({{ $row->id }})" icon="trash" />
                </flux:table.cell>

            </flux:table.row>

        @empty
            <flux:table.row>
                <flux:table.cell colspan="4">
                    <p class="py-4 text-center text-sm text-gray-500">
                        Belum ada data Fitur.
                    </p>
                </flux:table.cell>
            </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>
