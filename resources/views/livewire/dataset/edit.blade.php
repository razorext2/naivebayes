<form wire:submit.prevent="store" class="flex h-fit flex-col gap-2 lg:gap-4">

    <div>
        <flux:select wire:model="form.model_id" label="Tipe Model" placeholder="Pilih tipe model...">
            @forelse(\App\Models\DataMining\Model::all() as $row)
                <flux:select.option value="{{ $row->id }}">{{ $row->name }}</flux:select.option>
            @empty
                <flux:select.option value="">Belum ada data model</flux:select.option>
            @endforelse
        </flux:select>
    </div>

    <div>
        <flux:input type="text" placeholder="Input nama dataset..." label="Nama Dataset" wire:model="form.name" />
    </div>

    <div>
        <flux:select wire:model="form.type" label="Tipe Model" placeholder="Pilih tipe model...">
            <flux:select.option value="training">Training</flux:select.option>
            <flux:select.option value="testing">Testing</flux:select.option>
        </flux:select>
    </div>

    <div class="flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Simpan
        </flux:button>
    </div>
</form>
