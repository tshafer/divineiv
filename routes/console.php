<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule daily review imports at 2 AM local time
Schedule::command('reviews:import --source=all')
    ->daily()
    ->at('02:00')
    ->name('daily-review-import')
    ->withoutOverlapping(false)
    ->sendOutputTo(storage_path('logs/review-import.log'))
    ->onSuccess(function () {
        echo "✅ Daily review import completed successfully\n";
    })
    ->onFailure(function () {
        echo "❌ Daily review import failed\n";
    });
