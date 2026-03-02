<div class="space-y-6">

    <flux:card>

        <form wire:submit="store" class="space-y-6">

            {{-- info alternative --}}
            <div>
                <flux:input type="text" placeholder="Input nama siswa..." label="Nama Siswa" wire:model="form.name" />
            </div>

            <div>
                <flux:input type="text" placeholder="Input kelas siswa..." label="Kelas Siswa"
                    wire:model="form.class" />
            </div>

            <div>
                <flux:input type="text" placeholder="Input NIDN..." label="NIDN" wire:model="form.nidn" />
            </div>

            {{-- class label --}}
            <div>
                <flux:select label="Class" wire:model="class_label_id" placeholder="Pilih Class">
                    @foreach ($dataset->model->classLabels as $class)
                        <flux:select.option value="{{ $class->id }}">
                            {{ $class->name }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            {{-- features --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                @foreach ($features as $feature)
                    <div>

                        {{-- categorical --}}
                        @if ($feature->type === 'categorical')
                            <flux:select label="{{ $feature->name }}" wire:model="values.{{ $feature->id }}"
                                placeholder="Pilih {{ $feature->name }}">

                                @forelse ($feature->options as $option)
                                    <flux:select.option value="{{ $option->value }}">
                                        {{ $option->value }}
                                    </flux:select.option>
                                @empty
                                    <flux:select.option value="">Belum ada data</flux:select.option>
                                @endforelse

                            </flux:select>
                        @endif

                        {{-- numeric --}}
                        @if ($feature->type === 'numeric')
                            <flux:input type="number" label="{{ $feature->name }}"
                                wire:model="values.{{ $feature->id }}" />
                        @endif
                    </div>
                @endforeach

            </div>

            {{-- tombol --}}
            <div class="flex justify-end gap-3">

                <flux:button variant="primary" color="red"
                    href="{{ route('dataset.training-data.index', ['dataset' => $dataset]) }}" wire:navigate>
                    Batal
                </flux:button>

                <flux:button type="submit" variant="primary" color="blue" wire:loading.attr="disabled">
                    Simpan
                </flux:button>

            </div>

        </form>

    </flux:card>

</div>
