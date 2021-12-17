<?php

namespace Database\Factories;

use App\Models\Bucket;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Board;
use Illuminate\Support\Str;


class BucketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model
     *
     * @var string
     */
    protected $model = Bucket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $board = Board::factory()->create();

        return [
            'title' => Str::random(10),
            'board_id' => $board->id
        ];
    }
}
