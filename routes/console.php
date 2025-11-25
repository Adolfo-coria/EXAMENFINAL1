<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    // Imprimir directamente para evitar problemas estáticos con el tipo de $this
    echo Inspiring::quote().PHP_EOL;
})->purpose('Display an inspiring quote');
