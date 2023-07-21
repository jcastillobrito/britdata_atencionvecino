<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Roles;
use Str;
use DB;
use Freshwork\ChileanBundle\Rut;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        //trunca la tabla users
        DB::table('users')->truncate();

        $random_number = rand(1000000, 25000000);

        return [
            'nombres'           => $this->faker->firstName,
            'ap_paterno'        => $this->faker->lastName,
            'ap_materno'        => $this->faker->lastName,
            'nr_rut'            => (new Rut($random_number))->fix()->format() ,
            'id_externo'        => $this->faker->optional()->text(10),
            'email'             => $this->faker->unique()->safeEmail,
            'celular'           => $this->faker->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password'          => bcrypt('123456'), // Cambia 'password' por la contraseña que desees para todos los usuarios generados.
            'nr_institucion'    => 1,
            'last_login'        => $this->faker->optional()->dateTimeThisYear(),
            'nr_unidad'         => $this->faker->numberBetween(1, 12),
            'nr_depto'          => $this->faker->optional()->randomNumber(2),
            'nr_seccion'        => $this->faker->optional()->randomNumber(2),
            'tp_activo'         => $this->faker->boolean(80), // 80% de probabilidad de ser activo.
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }

    
}
