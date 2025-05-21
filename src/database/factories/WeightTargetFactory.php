<?php

namespace Database\Factories;

use App\Models\WeightTarget;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    protected $model = WeightTarget::class;

    public function definition()
    {
        return [
            'user_id' => '1',
            'target_weight' => $this->faker->randomFloat(1, 30, 90), 

        ];
    }
}
