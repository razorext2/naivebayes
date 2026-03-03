<flux:table :paginate="$this->records">
    <flux:table.columns>

        <flux:table.column>
            No.
        </flux:table.column>

        <flux:table.column>
            Nama Alternative
        </flux:table.column>

        <flux:table.column>
            Info Alternative
        </flux:table.column>

        <flux:table.column>
            Kelas
        </flux:table.column>

        @php
            $featureCount = $this->records?->first()?->dataset->model->features->count();
        @endphp

        <flux:table.column colspan="{{ $featureCount }}">
            Nilai
        </flux:table.column>

        <flux:table.column>
            #
        </flux:table.column>

    </flux:table.columns>

    <flux:table.rows>
        @forelse ($this->records as $index => $row)
            <flux:table.row :key="$row->id">
                <flux:table.cell>
                    {{ $index + 1 }}
                </flux:table.cell>

                <flux:table.cell>
                    {{ $row->alternative->name }}
                </flux:table.cell>

                <flux:table.cell class="whitespace-nowrap">
                    {{ implode(', ', array_values($row->alternative->data)) }}
                </flux:table.cell>

                <flux:table.cell>
                    {{ $row->classLabel->name }}
                </flux:table.cell>

                @foreach ($row->featureValues->sortBy('featureValues.feature_id') as $value)
                    <flux:table.cell>
                        {{ $value->feature->name }}: {{ $value->value }}
                    </flux:table.cell>
                @endforeach

                <flux:table.cell class="flex gap-x-2">
                    {{-- <flux:button size="sm" color="blue" variant="primary" wire:navigate
                        href="{{ route('dataset.edit', ['id' => $row->id]) }}" icon="pencil" /> --}}

                    <flux:button size="sm" color="red"
                        wire:confirm.prompt="Yakin ingin menghapus data Alternatif ini?\nKetik YA jika anda yakin|YA"
                        variant="primary" wire:click="delete({{ $row->alternative_id }})" icon="trash" />
                </flux:table.cell>

            </flux:table.row>

        @empty
            <flux:table.row>
                <flux:table.cell colspan="5">
                    <p class="py-4 text-center text-sm text-gray-500">
                        Belum ada data Fitur.
                    </p>
                </flux:table.cell>
            </flux:table.row>
        @endforelse
    </flux:table.rows>
</flux:table>
