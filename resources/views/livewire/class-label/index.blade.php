<flux:table :paginate="$this->classLabels">
    <flux:table.columns>

        <flux:table.column sortable :sorted="$sortBy === 'model_id'" :direction="$sortDirection"
            wire:click="sort('model_id')">
            Nama Model
        </flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
            wire:click="sort('name')">
            Nama Class
        </flux:table.column>

        <flux:table.column>
            #
        </flux:table.column>

    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->classLabels as $row)
            <flux:table.row :key="$row->id">
                <flux:table.cell class="flex items-center gap-3">
                    {{ $row->model->name }}
                </flux:table.cell>

                <flux:table.cell class="whitespace-nowrap">
                    {{ $row->name }}
                </flux:table.cell>

                <flux:table.cell class="flex gap-x-2">
                    <flux:button size="sm" color="blue" variant="primary" wire:navigate
                        href="{{ route('class-label.edit', ['id' => $row->id]) }}" icon="pencil" />

                    <flux:button size="sm" color="red"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                        wire:click="delete({{ $row->id }})" icon="trash" />
                </flux:table.cell>

            </flux:table.row>

        @empty
            <flux:table.row>
                <flux:table.cell colspan="4">
                    <p class="py-4 text-center text-sm text-gray-500">
                        Belum ada data Class.
                    </p>
                </flux:table.cell>
            </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>
