<div class="grid gap-2 lg:gap-4">
    {{-- form tambah opsi --}}
    <form wire:submit.prevent="store" class="flex h-fit flex-col gap-2 lg:gap-4">

        <div>
            <flux:input type="text" placeholder="Input opsi fitur..." label="Nilai Opsi" wire:model="form.value" />
        </div>

        <div>
            <flux:input type="number" placeholder="Input urutan opsi..." min="1" label="Urutan"
                wire:model="form.order" />
        </div>

        <div class="flex justify-start">
            <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
                Simpan
            </flux:button>
        </div>
    </form>

    <flux:separator class="mt-4" />
    <flux:heading size="lg">List Opsi</flux:heading>

    {{-- Daftar Opsi --}}
    <flux:table :paginate="$this->options">
        <flux:table.columns>

            <flux:table.column sortable :sorted="$sortBy === 'feature_id'" :direction="$sortDirection"
                wire:click="sort('feature_id')">
                Nama Fitur
            </flux:table.column>

            <flux:table.column sortable :sorted="$sortBy === 'value'" :direction="$sortDirection"
                wire:click="sort('value')">
                Nilai
            </flux:table.column>

            <flux:table.column sortable :sorted="$sortBy === 'order'" :direction="$sortDirection"
                wire:click="sort('order')">
                No Order
            </flux:table.column>

            <flux:table.column>
                #
            </flux:table.column>

        </flux:table.columns>

        <flux:table.rows>
            @forelse ($this->options as $row)
                <flux:table.row :key="$row->id">
                    <flux:table.cell class="flex items-center gap-3">
                        {{ $row->feature->name }}
                    </flux:table.cell>

                    <flux:table.cell class="whitespace-nowrap">
                        {{ $row->value }}
                    </flux:table.cell>

                    <flux:table.cell>
                        {{ $row->order }}
                    </flux:table.cell>

                    <flux:table.cell class="flex gap-x-2">

                        <flux:button size="sm" color="red"
                            wire:confirm.prompt="Yakin ingin menghapus?\nKetik YA jika anda yakin|YA" variant="primary"
                            wire:click="delete({{ $row->id }})" icon="trash" />

                    </flux:table.cell>

                </flux:table.row>

            @empty
                <flux:table.row>
                    <flux:table.cell colspan="4">
                        <p class="py-4 text-center text-sm text-gray-500">
                            Belum ada opsi Fitur.
                        </p>
                    </flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>

</div>
