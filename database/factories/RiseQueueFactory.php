<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Rise_Queue;
use App\Models\Sucursal;

class RiseQueueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RiseQueue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sucursal_id' => Sucursal::factory(),
            'tabla' => $this->faker->word,
            'clave' => $this->faker->word,
            'registro' => '{}',
            'upload_status' => $this->faker->randomElement(["pendiente","subido","fallo"]),
            'status_mensaje' => $this->faker->text,
        ];
    }
}
