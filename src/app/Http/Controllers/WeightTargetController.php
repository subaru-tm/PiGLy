<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeightTargetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Models\WeightLog;

class WeightTargetController extends Controller
{
    public function setting()
    {
        $user_id = Auth::id();
        $weight_target = WeightTarget::UserIDSearchTarget($user_id)->first();

        return view('goal_setting', compact('weight_target'));
    }

    public function update(WeightTargetRequest $request)
    {
        $user_id = Auth::id();

        $weight_target = [
            'user_id' => $user_id,
            'target_weight' => $request->target_weight
        ];

        WeightTarget::UserIDSearchTarget($user_id)->update($weight_target);

        return redirect('weight_logs');
    }
}
