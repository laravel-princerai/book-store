<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use App\Jobs\SendReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::with(['category', 'authors'])->paginate(10);
            return view('home', compact('books'));
        } catch (Exception $e) {
            Log::error('Error in BookController@index: ' . $e->getMessage());
            return redirect()->back()->withErrors('Unable to load books at this time.');
        }
    }

    public function show($id)
    {
        try {
            $book = Book::with(['category', 'authors', 'reviews.user'])->findOrFail($id);
            $averageRating = $book->reviews()->avg('rating');
            return view('book-details', compact('book', 'averageRating'));
        } catch (Exception $e) {
            Log::error('Error in BookController@show: ' . $e->getMessage());
            return redirect()->back()->withErrors('Unable to load book details at this time.');
        }
    }

    public function storeReview(Request $request, $id)
    {
        try {
            $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'review' => 'nullable|string',
            ]);

            $book = Book::findOrFail($id);

            $review = new Review([
                'user_id' => Auth::id(),
                'rating' => 6 - $request->rating,
                'review' => $request->review,
            ]);

            $book->reviews()->save($review);
            SendReviewNotification::dispatch($review);

            return redirect()->route('books.show', $book->id)->with('success', 'Review submitted successfully.');
        } catch (Exception $e) {
            Log::error('Error in BookController@storeReview: ' . $e->getMessage());
            return redirect()->back()->withErrors('Unable to submit review at this time.');
        }
    }
}
