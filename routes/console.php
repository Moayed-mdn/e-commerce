<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;


Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');



/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
*/

