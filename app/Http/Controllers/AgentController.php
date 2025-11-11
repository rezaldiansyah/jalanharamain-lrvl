<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    protected function ensureAgent(): void
    {
        $user = auth()->user();
        if (!$user || !in_array($user->role, ['agent', 'calon-agen'])) {
            abort(403, 'Akses hanya untuk agen atau calon-agen.');
        }
    }

    public function map()
    {
        $this->ensureAgent();
        return view('map.index');
    }

    public function itineraries()
    {
        $this->ensureAgent();
        return view('agent.itineraries.index');
    }
}