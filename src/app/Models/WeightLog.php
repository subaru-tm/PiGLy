<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'weight', 'calories', 'exercise_time', 'exercise_content'];

    public function user() {
        return $this->belongToMany('App\Models\User');
    }

    public function scopeUserIDSearchLog($query,$user_id) 
    {
        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }
    }

    public function scopeLastestWeightSearch($query, $date)
    {
        if (!empty($date)) {
            $query->where('date', $date);
        }
    }

    public function scopeFromDateSearch($query, $from)
    {
        if(!empty($from)) {
            $query->where('date', '>=' , $from);
        }
    }

    public function scopeUntilDateSearch($query, $until)
    {
        if(!empty($until)) {
            $query->where('date', '<=' , $until);
        }
    }

}
