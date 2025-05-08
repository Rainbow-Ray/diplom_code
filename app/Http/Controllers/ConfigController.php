<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    public function clearRoute()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
    }
}
