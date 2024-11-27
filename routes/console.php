<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Storage;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    collect(Storage::disk('temp')->allFiles())->each(function ($file) {
        if (now()->diffInHours(Storage::disk('temp')->lastModified($file)) >= 24) {
            Storage::disk('temp')->delete($file);
        }
    });
})->daily();
