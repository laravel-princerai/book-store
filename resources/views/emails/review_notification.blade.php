<!DOCTYPE html>
<html>
<head>
    <title>New Review Submitted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1e3c72;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #0d1a36;
            border-radius: 10px;
            padding: 20px 30px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #1e90ff;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
            color: #cbd5e1;
        }
        strong {
            color: #63b3ed;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #7f8c9d;
            text-align: center;
        }
        a {
            color: #63b3ed;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Review for "{{ $book->title }}"</h1>
        <p><strong>Reviewer:</strong> <a href="mailto:{{ $user->email }}">{{ $user->name }}</a></p>
        <p><strong>Rating:</strong> {{ $review->rating }} / 5</p>
        <p><strong>Review:</strong></p>
        <p>{{ $review->review }}</p>
        <div class="footer">
            &copy; {{ date('Y') }} Online Bookstore. All rights reserved.
        </div>
    </div>
</body>
</html>
