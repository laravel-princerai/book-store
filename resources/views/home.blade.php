@extends('layouts.app')

@section('content')
<div class="container py-4">
    <style>
        .book-card {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            color: white;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .book-price {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }
        .book-description {
            font-size: 0.9rem;
            line-height: 1.4;
            margin-bottom: 20px;
            opacity: 0.8;
        }
        .buy-btn {
            background-color: #1e90ff;
            border: none;
            border-radius: 8px;
            padding: 10px 0;
            font-weight: 600;
            color: white;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: block;
        }
        .buy-btn:hover {
            background-color: #1c7ed6;
            text-decoration: none;
            color: white;
        }
    </style>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($books as $book)
        <div class="col">
            <div class="book-card">
                <div>
                    <h5 class="text-uppercase" style="opacity: 0.7;">{{ $book->title }}</h5>
                    <p class="book-description">{{ \Illuminate\Support\Str::limit($book->description, 120) }}</p>
                    <p class="mb-1"><strong>Authors:</strong>
                        @foreach($book->authors as $author)
                            {{ $author->name }}@if(!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
                <div>
                    <div class="book-price">${{ number_format($book->price, 2) }}</div>
<a href="{{ route('books.show', $book->id) }}" class="buy-btn">Review</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
