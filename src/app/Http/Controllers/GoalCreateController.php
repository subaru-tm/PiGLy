<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GoalCreateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class GoalCreateController extends Controller
{
    public function create()
    {
        return view('goal_create');
    }

    public function store(GoalCreateRequest $request)
    {
        $user_id = Auth::id();

        $weight_target = WeightTarget::create([
            'user_id' => $user_id,
            'target_weight' => $request->target_weight,
        ]);

        $weight_log = WeightLog::create([
            'user_id' => $user_id,
            'date' => now()->format('Y-m-d'),
            'weight' => $request->weight,
        ]);

        return redirect('weight_logs');
    }

}
