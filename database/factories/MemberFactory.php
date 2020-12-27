<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'avatar' => 'https://i.pravatar.cc/350?u='.rand(1,5000),

            'phone' => $this->faker->unique()->phoneNumber,
            'age' => $this->faker->numberBetween(10 , 80) ,
            'gender' => random_int(0,1),
            'address' => $this->faker->address,
        ];
    }
}
