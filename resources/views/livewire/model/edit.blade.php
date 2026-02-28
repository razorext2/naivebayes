<form wire:submit.prevent="store" class="flex h-fit flex-col gap-2 lg:gap-4">

    <div>
        <flux:input type="text" placeholder="Input nama model..." label="Nama Model" wire:model="form.name" />
    </div>

    <div>
        <flux:select wire:model="form.algorithm_type" label="Tipe Algoritma" placeholder="Pilih tipe algoritma...">
            <flux:select.option value="bernouli">Bernouli</flux:select.option>
            <flux:select.option value="gaussian">Gaussian</flux:select.option>
            <flux:select.option value="multinominal">Multinominal</flux:select.option>
        </flux:select>
    </div>

    <div>
        <flux:textarea wire:model="form.description" label="Deskripsi"
            placeholder="Deskripsikan kategori produk dalam beberapa kata..." />
    </div>

    <div class="max-w-xl">
        <flux:radio.group label="Status" variant="cards" class="max-sm:flex-col">

            <flux:radio value="1" checked>
                <flux:radio.indicator />

                <flux:heading class="leading-4">Aktif</flux:heading>
            </flux:radio>

            <flux:radio value="0">
                <flux:radio.indicator />

                <flux:heading class="leading-4">Tidak aktif</flux:heading>
            </flux:radio>
        </flux:radio.group>
    </div>

    <div class="flex justify-start">
        <flux:button type="submit" icon:trailing="chevron-right" variant="primary" color="green">
            Simpan
        </flux:button>
    </div>
</form>
