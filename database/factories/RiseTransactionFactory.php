<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\app\Models\Rise_Transaction;
use App\app\Models\Sucursal;

class RiseTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RiseTransaction::class;

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
            'syspro_status' => $this->faker->randomElement(["pendiente","procesado","fallo"]),
            'syspro_mensaje' => $this->faker->text,
        ];
    }
}
