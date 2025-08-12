<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BunnyService;

class TestController extends Controller
{
    public function testBunny()
    {
        $bunnyService = new BunnyService();
        $result = $bunnyService->testConnection();
        
        return response()->json([
            'config' => [
                'storage_zone' => config('services.bunny.storage_zone'),
                'pull_zone' => config('services.bunny.pull_zone'),
                'region' => config('services.bunny.region'),
                'access_key_exists' => !empty(config('services.bunny.access_key'))
            ],
            'connection_test' => $result
        ]);
    }
}
