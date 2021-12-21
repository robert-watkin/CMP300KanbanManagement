<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Bucket;
use Psy\Util\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     *
     * @var string
     */
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bucket = Bucket::factory()->create();

        return [
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(100),
            'deadline' => $this->faker->date(),
            'bucket_id' => $bucket->id
        ];
    }
}
