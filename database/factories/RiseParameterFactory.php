<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\app\Models\Rise_Parameter;
use App\app\Models\Sucursal;

class RiseParameterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RiseParameter::class;

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
        ];
    }
}
