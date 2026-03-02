<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <x-utils.bread-crumbs />
        <flux:heading size="xl">Tambah Opsi Fitur</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Berikut adalah daftar opsi fitur yang digunakan dalam sistem.
            Anda dapat membuat, mengatur, dan mengelola opsi fitur sesuai kebutuhan analisis.
        </p>

        <div class="flex items-center justify-start">
            <flux:button href="{{ route('feature.index') }}" wire:navigate icon="chevron-left" variant="primary"
                color="red">
                Kembali
            </flux:button>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">

            @livewire('feature.options', ['id' => $id])

        </div>
    </div>
</x-layouts::app>
