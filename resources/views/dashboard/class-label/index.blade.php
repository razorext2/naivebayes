<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <x-utils.bread-crumbs />

        <flux:heading size="xl">Daftar Class Label</flux:heading>

        <p class="text-sm text-gray-800 dark:text-white">
            Berikut adalah daftar class klasifikasi yang digunakan dalam sistem.
            Anda dapat membuat, mengatur, dan mengelola class Naive Bayes sesuai kebutuhan analisis.
        </p>

        <div class="flex items-center justify-start">
            <flux:button href="{{ route('class-label.create') }}" wire:navigate icon="plus" variant="primary"
                color="green">
                Tambah Class
            </flux:button>
        </div>

        <div
            class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 p-2 lg:p-4 dark:border-neutral-700">

            @livewire('class-label.index')

        </div>
    </div>
</x-layouts::app>
