<?php

namespace Database\Factories;

use App\Models\Frete;
use Illuminate\Database\Eloquent\Factories\Factory;

class FreteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Frete::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'veiculo_id' => rand(2,8),
            'valor' => rand(10,50),
            'data_inicio' => now(),
            'data_fim' => now()->addDays(3),
            'status' => $this->faker->randomElement(['iniciado', 'em trânsito', 'concluído']),
        ];
    }

}
