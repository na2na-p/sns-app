<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends Factory<Favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $uuid = Uuid::uuid7();

        return [
            'id' => $uuid->toString(),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'message_id' => function () {
                return Message::factory()->create()->id;
            },
        ];
    }
}
