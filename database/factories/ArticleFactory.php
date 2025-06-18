<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->paragraph(1),
            'excerpt' => $this->faker->paragraph(5),
            'img_url' => 'http://loremflickr.com/800/600?lock='.
                $this->faker->numberBetween(1, 65535),
            'body' => '<p>'.implode('</p><p>', $this->faker->paragraphs(5)).'</p>',
            'published_at' => $this->faker->dateTime
        ];
    }
}
