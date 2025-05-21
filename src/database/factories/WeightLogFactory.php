<?php

namespace Database\Factories;

use App\Models\WeightLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;
    
    public function definition()
    {
        return [
            'user_id' => '1',
            'date' => $this->faker->dateTimeBetween($startDate = '-12 week', $endDate = 'now'),
            'weight' => $this->faker->randomFloat(1, 30, 120),
            'calories' => $this->faker->numberBetween($min = 0, $max = 10000),
            'exercise_time' => $this->faker->time($format = 'H:i', $max = '03:00'),
            'exercise_content' => $this->faker->randomElement([
                '有酸素運動',
                '筋トレ',
                'ストレッチ',
                '運動していない'
                ])
        ];
    }
}
