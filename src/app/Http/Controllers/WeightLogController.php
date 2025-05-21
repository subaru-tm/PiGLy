<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WeightLogRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;


class WeightLogController extends Controller
{
    public function weight_logs() {
        $user_id = Auth::id();
        $weight_logs = WeightLog::UserIdSearchLog($user_id)->paginate(8);

        $last_date = WeightLog::UserIdSearchLog($user_id)->max('date');
        $last_weight = WeightLog::LastestWeightSearch($last_date)->first();
        $weight_target = WeightTarget::UserIdSearchTarget($user_id)->first();

        return view('weight_logs', compact('weight_logs', 'weight_target', 'last_weight'));
    }

    public function search(Request $request) {
        $user_id = Auth::id();
        $from = $request['from'];
        $until = $request['until'];
        $weight_logs = WeightLog::UserIdSearchLog($user_id)->FromDateSearch($from)->UntilDateSearch($until)->paginate(8);
        $logs_count = WeightLog::UserIdSearchLog($user_id)->FromDateSearch($from)->UntilDateSearch($until)->count();

        $last_date = WeightLog::UserIdSearchLog($user_id)->max('date');
        $last_weight = WeightLog::LastestWeightSearch($last_date)->first();
        $weight_target = WeightTarget::UserIdSearchTarget($user_id)->first();

        return view('weight_logs', compact('weight_logs', 'weight_target', 'last_weight', 'from', 'until', 'logs_count'));
    }

    public function store(WeightLogRequest $request) {
        $user_id = Auth::id();
        $weight_log = WeightLog::create([
            'user_id' => $user_id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect('weight_logs.#create');
    }

    public function detail($weightLogId) {
        $weight_log = WeightLog::find($weightLogId);

        return view('log_detail', compact('weight_log'));
    }

    public function update(WeightLogRequest $request, $weightLogId) {
        $weight_log = $request->only(['date', 'weight', 'calories', 'exercise_time', 'exercise_content']);
        WeightLog::find($weightLogId)->update($weight_log);

        return redirect('weight_logs');
    }

    public function destroy(Request $request, $weightLogId) {
        WeightLog::find($weightLogId)->delete();

        return redirect('weight_logs');
    }
}
