@php
    $breadcrumbs = \App\Support\Breadcrumbs::generate(Route::currentRouteName());
@endphp

<flux:breadcrumbs>
    @foreach ($breadcrumbs as $crumb)
        @if (isset($crumb['route']))
            <flux:breadcrumbs.item href="{{ route($crumb['route']) }}" separator="slash" wire:navigate>
                {{ $crumb['label'] }}
            </flux:breadcrumbs.item>
        @else
            <flux:breadcrumbs.item separator="slash">
                {{ $crumb['label'] }}
            </flux:breadcrumbs.item>
        @endif
    @endforeach
</flux:breadcrumbs>
