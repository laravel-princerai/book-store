<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create some users
        User::factory()->count(5)->create();

        // Create categories
        $categories = Category::factory()->count(3)->create();

        // Create authors
        $authors = Author::factory()->count(5)->create();

        // Create books and attach categories and authors
        Book::factory()->count(20)->create()->each(function ($book) use ($categories, $authors) {
            // Attach a random category
            $book->category()->associate($categories->random());
            $book->save();

            // Attach random authors
            $book->authors()->attach($authors->random(rand(1, 3))->pluck('id')->toArray());

            // Create reviews for the book
            Review::factory()->count(rand(1, 5))->create([
                'book_id' => $book->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
