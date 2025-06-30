<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;

class BookDataProcessor
{
    /**
     * Process an array of book data to create or update books with categories and authors.
     *
     * @param array \$booksData
     * @return void
     */
    public function process(array $booksData)
    {
        foreach ($booksData as $bookData) {
            // Process category
            $category = Category::firstOrCreate(['name' => $bookData['category']]);

            // Process book
            $book = Book::updateOrCreate(
                ['title' => $bookData['title']],
                [
                    'description' => $bookData['description'] ?? null,
                    'price' => $bookData['price'] ?? 0,
                    'category_id' => $category->id,
                ]
            );

            // Process authors
            $authorIds = [];
            if (!empty($bookData['authors']) && is_array($bookData['authors'])) {
                foreach ($bookData['authors'] as $authorName) {
                    $author = Author::firstOrCreate(['name' => $authorName]);
                    $authorIds[] = $author->id;
                }
            }

            // Sync authors
            $book->authors()->sync($authorIds);
        }
    }
}
