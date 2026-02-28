<?php

namespace App\Support;

class Breadcrumbs
{
    public static function generate(string $routeName): array
    {
        $map = [
            'dashboard' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
            ],

            'model.index' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Model', 'route' => 'model.index'],
            ],

            'model.create' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Model', 'route' => 'model.index'],
                ['label' => 'Create'],
            ],

            'model.edit' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Model', 'route' => 'model.index'],
                ['label' => 'Edit'],
            ],

            'feature.index' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Feature', 'route' => 'feature.index'],
            ],

            'feature.create' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Feature', 'route' => 'feature.index'],
                ['label' => 'Create'],
            ],

            'feature.edit' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Feature', 'route' => 'feature.index'],
                ['label' => 'Edit'],
            ],

            'class-label.index' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Class Label', 'route' => 'class-label.index'],
            ],

            'class-label.create' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Class Label', 'route' => 'class-label.index'],
                ['label' => 'Create'],
            ],

            'class-label.edit' => [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'Class Label', 'route' => 'class-label.index'],
                ['label' => 'Edit'],
            ],

        ];

        return $map[$routeName] ?? [
            ['label' => 'Dashboard', 'route' => 'dashboard'],
        ];
    }
}
