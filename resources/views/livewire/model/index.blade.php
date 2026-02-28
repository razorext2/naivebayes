<flux:table :paginate="$this->models">
    <flux:table.columns>

        <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
            wire:click="sort('name')">
            Nama Model
        </flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'algorithm_type'" :direction="$sortDirection"
            wire:click="sort('algorithm_type')">
            Tipe Algoritma
        </flux:table.column>

        <flux:table.column sortable :sorted="$sortBy === 'is_active'" :direction="$sortDirection"
            wire:click="sort('is_active')">
            Status
        </flux:table.column>

        <flux:table.column>
            #
        </flux:table.column>

    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->models as $row)
            <flux:table.row :key="$row->id">
                <flux:table.cell class="flex items-center gap-3">
                    {{ $row->name }}
                </flux:table.cell>

                <flux:table.cell class="whitespace-nowrap">
                    {{ $row->algorithm_type }}
                </flux:table.cell>

                <flux:table.cell>
                    @if ($row->is_active)
                        <flux:badge size="sm" color="green">Aktif</flux:badge>
                    @else
                        <flux:badge size="sm" color="red">Tidak Aktif</flux:badge>
                    @endif
                </flux:table.cell>

                <flux:table.cell class="flex gap-x-2">
                    <flux:button size="sm" color="blue" variant="primary" wire:navigate
                        href="{{ route('model.edit', ['id' => $row->id]) }}" icon="pencil" />

                    <flux:button size="sm" color="red"
                        wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                        wire:click="delete({{ $row->id }})" icon="trash" />
                </flux:table.cell>

            </flux:table.row>

        @empty
            <flux:table.row>
                <flux:table.cell colspan="4">
                    <p class="py-4 text-center text-sm text-gray-500">
                        Belum ada data Model.
                    </p>
                </flux:table.cell>
            </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>
