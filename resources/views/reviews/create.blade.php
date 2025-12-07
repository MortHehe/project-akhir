@extends('layouts.auth')

@section('title', 'Write a Review')

@section('additional-styles')
<style>
    .review-form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        max-width: 800px;
        margin: 0 auto;
        border: 2px solid #f5f5f5;
    }

    .form-header {
        text-align: center;
        margin-bottom: 35px;
        padding-bottom: 25px;
        border-bottom: 3px solid #667eea;
    }

    .form-header h1 {
        font-size: 32px;
        font-weight: 900;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .form-header p {
        color: #666;
        font-size: 16px;
        font-weight: 600;
    }

    .order-info {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        padding: 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        border: 2px solid rgba(102, 126, 234, 0.2);
    }

    .order-info h3 {
        font-size: 18px;
        font-weight: 700;
        color: #667eea;
        margin-bottom: 10px;
    }

    .order-info p {
        color: #666;
        margin: 5px 0;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .required {
        color: #dc3545;
        margin-left: 3px;
    }

    .rating-input {
        display: flex;
        gap: 10px;
        flex-direction: row-reverse;
        justify-content: flex-end;
        font-size: 40px;
        margin-bottom: 10px;
    }

    .rating-input input {
        display: none;
    }

    .rating-input label {
        cursor: pointer;
        color: #ddd;
        transition: all 0.2s;
    }

    .rating-input input:checked ~ label,
    .rating-input label:hover,
    .rating-input label:hover ~ label {
        color: #ffc107;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 14px;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        font-size: 15px;
        font-family: inherit;
        transition: all 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .form-hint {
        font-size: 13px;
        color: #999;
        margin-top: 5px;
        display: block;
    }

    .error-message {
        color: #dc3545;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 35px;
        padding-top: 25px;
        border-top: 2px solid #f0f0f0;
    }

    .btn {
        padding: 14px 32px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        border: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
    }

    .btn-cancel:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 2px solid #f5c6cb;
    }
</style>
@endsection

@section('content')
    @if(session('error'))
        <div class="alert alert-error">✗ {{ session('error') }}</div>
    @endif

    <div class="review-form-card">
        <div class="form-header">
            <h1>⭐ Write a Review</h1>
            <p>Share your experience working with this freelancer</p>
        </div>

        <div class="order-info">
            <h3>📋 Order Details</h3>
            <p><strong>Project:</strong> {{ $order->job_title }}</p>
            <p><strong>Freelancer:</strong> {{ $order->freelancer->name }}</p>
            <p><strong>Completed:</strong> {{ $order->completed_at->format('M d, Y') }}</p>
        </div>

        <form action="{{ route('reviews.store', $order) }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">
                    Overall Rating<span class="required">*</span>
                </label>
                <div class="rating-input">
                    <input type="radio" name="rating" value="5" id="star5" {{ old('rating') == 5 ? 'checked' : '' }} required>
                    <label for="star5">★</label>
                    <input type="radio" name="rating" value="4" id="star4" {{ old('rating') == 4 ? 'checked' : '' }}>
                    <label for="star4">★</label>
                    <input type="radio" name="rating" value="3" id="star3" {{ old('rating') == 3 ? 'checked' : '' }}>
                    <label for="star3">★</label>
                    <input type="radio" name="rating" value="2" id="star2" {{ old('rating') == 2 ? 'checked' : '' }}>
                    <label for="star2">★</label>
                    <input type="radio" name="rating" value="1" id="star1" {{ old('rating') == 1 ? 'checked' : '' }}>
                    <label for="star1">★</label>
                </div>
                @error('rating')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="title">
                    Review Title
                </label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    class="form-input"
                    placeholder="Summarize your experience in one line"
                    value="{{ old('title') }}"
                    maxlength="255"
                >
                <span class="form-hint">Optional - A short headline for your review</span>
                @error('title')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="comment">
                    Your Review<span class="required">*</span>
                </label>
                <textarea
                    name="comment"
                    id="comment"
                    class="form-textarea"
                    placeholder="Share details about your experience, the quality of work, communication, and what you liked or didn't like..."
                    required
                    maxlength="2000"
                >{{ old('comment') }}</textarea>
                <span class="form-hint">Required - Share your detailed feedback (max 2000 characters)</span>
                @error('comment')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('orders.show', $order) }}" class="btn btn-cancel">
                    Cancel
                </a>
                <button type="submit" class="btn btn-submit">
                    📝 Submit Review
                </button>
            </div>
        </form>
    </div>
@endsection
