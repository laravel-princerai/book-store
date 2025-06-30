@extends('layouts.app')

@section('content')
<div class="container text-white">
    <style>
        .book-detail-card {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            padding: 30px;
            margin-bottom: 30px;
            margin-top: 2rem;
        }
        .book-price {
            font-size: 3rem;
            font-weight: 700;
            margin: 15px 0;
        }
        .book-description {
            font-size: 1.1rem;
            line-height: 1.5;
            opacity: 0.85;
        }
        .review-card {
            background-color: #2a5298;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .review-rating {
            font-weight: 600;
            color: #cbd5e1;
        }
        .submit-review-form label {
            font-weight: 600;
            color: #cbd5e1;
        }
        .submit-review-form textarea,
        .submit-review-form select {
            background-color: #1e3c72;
            border: none;
            color: white;
        }
        .submit-review-form textarea::placeholder {
            color: #a0aec0;
        }
        .submit-review-form .btn-primary {
            background-color: #1e90ff;
            border: none;
        }
        .submit-review-form .btn-primary:hover {
            background-color: #1c7ed6;
        }
        a {
            color: #1e90ff;
        }
        h3 {
            color: #cbd5e1;
        }
        p, strong {
            color: #cbd5e1;
        }
    </style>

    <div class="book-detail-card">
        <h1>{{ $book->title }}</h1>
        <p class="book-description">{{ $book->description }}</p>
        <p class="book-price">${{ number_format($book->price, 2) }}</p>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <p><strong>Authors:</strong>
            @foreach ($book->authors as $author)
                {{ $author->name }}@if (!$loop->last), @endif
            @endforeach
        </p>
        <p><strong>Average Rating:</strong> {{ number_format($averageRating, 2) ?? 'No ratings yet' }}</p>
    </div>

    <h3>User Reviews</h3>
    @forelse ($book->reviews as $review)
        <div class="review-card">
            <h5>{{ $review->user->name }} <small class="review-rating">rated {{ $review->rating }}/5</small></h5>
            <p>{{ $review->review }}</p>
            <small>{{ $review->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse

    @auth
    <h3>Submit a Review</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('books.review', $book->id) }}" method="POST" class="submit-review-form">
        @csrf
        <div class="form-group mb-3">
            <label for="rating">Rating (1 to 5):</label>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                    <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
                @endfor
            </div>
            @error('rating')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <style>
            .star-rating {
                direction: rtl;
                font-size: 1.5rem;
                unicode-bidi: bidi-override;
                display: inline-flex;
            }
            .star-rating input[type="radio"] {
                display: none;
            }
            .star-rating label {
                color: #ccc;
                cursor: pointer;
                padding: 0 5px;
                transition: color 0.2s;
            }
            .star-rating input[type="radio"]:checked ~ label,
            .star-rating label:hover,
            .star-rating label:hover ~ label {
                color: #1e90ff;
            }
        </style>
        <div class="form-group mb-3">
            <label for="review">Review:</label>
            <textarea name="review" id="review" class="form-control" rows="4" placeholder="Write your review here...">{{ old('review') }}</textarea>
            @error('review')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
    </form>
    @else
    <p>Please <a href="{{ route('login') }}">login</a> to submit a review.</p>
    @endauth
</div>
@endsection
