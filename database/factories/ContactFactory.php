<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'last_name'     => $this->faker->lastName,
            'first_name'    => $this->faker->firstName,
            'gender'        => $this->faker->randomElement(['男性', '女性', 'その他']),
            'email'         => $this->faker->unique()->safeEmail,
            'tel'           => $this->faker->numerify('0##########'), // 例: 08012345678
            'address'       => $this->faker->address,
            'building'      => $this->faker->optional()->secondaryAddress,
            'category_id'   => $this->faker->numberBetween(1, 3), // 外部キーとしてのカテゴリID
            'detail'        => $this->faker->realText(80),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }
}
