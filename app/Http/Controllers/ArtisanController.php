<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function cacheClear(){
        Artisan::call('cache:clear');
        echo "Cached Cleared";
    }

    public function cacheAll(){
        Artisan::call('config:cache');
        Artisan::call('view:cache');
        Artisan::call('route:cache');
        echo "Cached Config, Routes and Views";
    }

    public function cacheConfig(){
        Artisan::call('config:cache');
        echo "Cached Config";
    }

    public function cacheView(){
        Artisan::call('view:cache');
        echo "Cached Views";
    }

    public function cacheRoute(){
        Artisan::call('route:cache');
        echo "Cached Route";
    }
}
