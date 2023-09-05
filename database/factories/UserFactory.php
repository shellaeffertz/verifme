<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();

        return [
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'username' => $faker->userName,
            'nickname' => $faker->firstName,
            'password' => bcrypt('password'), // You can change 'password' to any default password you prefer
            'referrer' => $faker->optional()->numberBetween(1, 100),
            'balance' => $faker->randomFloat(2, 0, 1000),
            'type' => $faker->randomElement(['individual', 'business']),
            'channel_id' => $faker->optional()->numberBetween(1, 10),
            'is_admin' => $faker->boolean(10),
            'is_banned' => $faker->boolean(5),
            'is_seller' => $faker->boolean(50),
            'commission' => $faker->randomFloat(2, 0, 1),
            'is_affiliate' => $faker->boolean(30),
            'affiliate_commission' => $faker->randomFloat(2, 0, 0.5),
            'affiliate_code' => $faker->unique()->word,
            'affiliate_balance' => $faker->randomFloat(2, 0, 100),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}