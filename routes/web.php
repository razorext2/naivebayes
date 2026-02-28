<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('dashboard')
        ->name('')
        ->group(function () {
            Route::view('/', 'dashboard')->name('dashboard');

            // model
            Route::view('/models', 'dashboard.model.index')->name('model.index');
            Route::view('/models/create', 'dashboard.model.create')->name('model.create');
            Route::view('/models/{id}/edit', 'dashboard.model.edit')->name('model.edit');

            // feature
            Route::view('/features', 'dashboard.feature.index')->name('feature.index');
            Route::view('/features/create', 'dashboard.feature.create')->name('feature.create');
            Route::view('/features/{id}/edit', 'dashboard.feature.edit')->name('feature.edit');

            // classlabel
            Route::view('/class-labels', 'dashboard.class-label.index')->name('class-label.index');
            Route::view('/class-labels/create', 'dashboard.class-label.create')->name('class-label.create');
            Route::view('/class-labels/{id}/edit', 'dashboard.class-label.edit')->name('class-label.edit');

            // dataset
            Route::view('/datasets', 'dashboard.dataset.index')->name('dataset.index');
            Route::view('/datasets/create', 'dashboard.dataset.create')->name('dataset.create');
            Route::view('/datasets/{id}/edit', 'dashboard.dataset.edit')->name('dataset.edit');
            Route::view('/datasets/{dataset}/training-data', 'dashboard.training-data.index')->name('dataset.training-data.index');
            Route::view('/datasets/{dataset}/training-data/create', 'dashboard.training-data.create')->name('dataset.training-data.create');

            // featurevalue
            Route::view('/feature-value', 'dashboard.feature-value.index')->name('feature-value.index');
            Route::view('/feature-value/create', 'dashboard.feature-value.create')->name('feature-value.create');
            Route::view('/feature-value/{id}/edit', 'dashboard.feature-value.edit')->name('feature-value.edit');

        });
});

require __DIR__.'/settings.php';
