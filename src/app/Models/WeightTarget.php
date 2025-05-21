<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightTarget extends Model
{
    use HasFactory;

    protected $table = 'weight_target';

    protected $fillable = ['user_id', 'target_weight'];

    public function user() {
        return $this->belongTo('App\Models\User');
    }

    public function scopeUserIDSearchTarget($query,$user_id) 
    {
        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }
    }

}
