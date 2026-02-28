<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('dashboard')
        ->name('')
        ->group(function () {
            Route::view('/', 'dashboard')->name('dashboard');

            // model
            Route::view('/model', 'dashboard.model.index')->name('model.index');
            Route::view('/model/create', 'dashboard.model.create')->name('model.create');
            Route::view('/model/{id}/edit', 'dashboard.model.edit')->name('model.edit');

            // feature
            Route::view('/feature', 'dashboard.feature.index')->name('feature.index');
            Route::view('/feature/create', 'dashboard.feature.create')->name('feature.create');
            Route::view('/feature/{id}/edit', 'dashboard.feature.edit')->name('feature.edit');

            // classlabel
            Route::view('/class-label', 'dashboard.class-label.index')->name('class-label.index');
            Route::view('/class-label/create', 'dashboard.class-label.create')->name('class-label.create');
            Route::view('/class-label/{id}/edit', 'dashboard.class-label.edit')->name('class-label.edit');

            // dataset
            Route::view('/dataset', 'dashboard.dataset.index')->name('dataset.index');
            Route::view('/dataset/create', 'dashboard.dataset.create')->name('dataset.create');
            Route::view('/dataset/{id}/edit', 'dashboard.dataset.edit')->name('dataset.edit');

            // datasetrecord
            Route::view('/dataset-record', 'dashboard.dataset-record.index')->name('dataset-record.index');
            Route::view('/dataset-record/create', 'dashboard.dataset-record.create')->name('dataset-record.create');
            Route::view('/dataset-record/{id}/edit', 'dashboard.dataset-record.edit')->name('dataset-record.edit');

            // featurevalue
            Route::view('/feature-value', 'dashboard.feature-value.index')->name('feature-value.index');
            Route::view('/feature-value/create', 'dashboard.feature-value.create')->name('feature-value.create');
            Route::view('/feature-value/{id}/edit', 'dashboard.feature-value.edit')->name('feature-value.edit');

        });
});

require __DIR__.'/settings.php';
