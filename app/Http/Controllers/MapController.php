<?php

namespace App\Http\Controllers;

use App\Models\Poi;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map.index');
    }

    public function pois(Request $request)
    {
        $city = $request->query('city'); // optional filter
        $query = Poi::query()->where('is_active', true)->orderByDesc('priority')->orderBy('name');

        if ($city) {
            $query->where('city', $city);
        }

        return response()->json([
            'data' => $query->get(['id','name','category','city','lat','lng','address','description']),
        ]);
    }
}