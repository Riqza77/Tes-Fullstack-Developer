<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Male','Female']);
        if($gender == 'Male'){
            $jns = 'Laki - Laki';
        }else if ($gender == 'Female'){
            $jns = 'Perempuan';
        }
        return [
            'nip'           => $this->faker->numerify('#########'),
            'nama'          => $this->faker->name($gender),
            'email'         => $this->faker->unique()->safeEmail(),
            'no_telp'       => $this->faker->numerify('###########'),
            'agama'         => $this->faker->randomElement(['Islam','Kristen','Buddha','Hindu','Konghucu']),
            'jenis_kelamin' => $jns,
            'status_nikah'=> $this->faker->randomElement(['Belum Menikah','Sudah Menikah']),
            'tgl_bergabung' => now(),
        ];
    }
}
