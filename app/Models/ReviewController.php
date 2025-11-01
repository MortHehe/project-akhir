<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isFreelancer()) {
            // Freelancer sees reviews they received
            $reviews = Review::with(['user', 'order'])
                ->where('freelancer_id', $user->id)
                ->published()
                ->latest()
                ->paginate(20);
        } else {
            // Users see reviews they wrote
            $reviews = Review::with(['freelancer', 'order'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(20);
        }
        
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review
     */
    public function create(Order $order)
    {
        // Check if user owns the order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        // Check if order is completed
        if (!$order->isCompleted()) {
            return back()->with('error', 'You can only review completed orders.');
        }
        
        // Check if already reviewed
        if ($order->hasReview()) {
            return back()->with('error', 'You have already reviewed this order.');
        }
        
        return view('reviews.create', compact('order'));
    }

    /**
     * Store a newly created review
     */
    public function store(Request $request, Order $order)
    {
        // Validate
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'required|string|max:2000',
            'quality_rating' => 'nullable|integer|min:1|max:5',
            'communication_rating' => 'nullable|integer|min:1|max:5',
            'deadline_rating' => 'nullable|integer|min:1|max:5',
            'professionalism_rating' => 'nullable|integer|min:1|max:5',
        ]);

        // Authorization checks
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        if (!$order->isCompleted()) {
            return back()->with('error', 'You can only review completed orders.');
        }
        
        if ($order->hasReview()) {
            return back()->with('error', 'You have already reviewed this order.');
        }

        // Create review
        $review = Review::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'freelancer_id' => $order->freelancer_id,
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'comment' => $validated['comment'],
            'quality_rating' => $validated['quality_rating'] ?? null,
            'communication_rating' => $validated['communication_rating'] ?? null,
            'deadline_rating' => $validated['deadline_rating'] ?? null,
            'professionalism_rating' => $validated['professionalism_rating'] ?? null,
            'is_published' => true,
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Thank you for your review!');
    }

    /**
     * Display the specified review
     */
    public function show(Review $review)
    {
        $review->load(['user', 'freelancer', 'order']);
        
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the review
     */
    public function edit(Review $review)
    {
        // Only review author can edit
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        $review->load('order');
        
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the review
     */
    public function update(Request $request, Review $review)
    {
        // Authorization
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'required|string|max:2000',
            'quality_rating' => 'nullable|integer|min:1|max:5',
            'communication_rating' => 'nullable|integer|min:1|max:5',
            'deadline_rating' => 'nullable|integer|min:1|max:5',
            'professionalism_rating' => 'nullable|integer|min:1|max:5',
        ]);

        $review->update($validated);

        return redirect()->route('reviews.show', $review)
            ->with('success', 'Review updated successfully!');
    }

    /**
     * Mark review as helpful
     */
    public function markHelpful(Review $review)
    {
        $review->increment('helpful_count');
        
        return back()->with('success', 'Thanks for your feedback!');
    }

    /**
     * Admin: Verify review
     */
    public function verify(Review $review)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }
        
        $review->update(['is_verified' => true]);
        
        return back()->with('success', 'Review verified!');
    }

    /**
     * Admin: Toggle publish status
     */
    public function togglePublish(Review $review)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }
        
        $review->update(['is_published' => !$review->is_published]);
        
        return back()->with('success', 'Review status updated!');
    }

    /**
     * Delete review (admin or author)
     */
    public function destroy(Review $review)
    {
        // Only admin or review author can delete
        if (!Auth::user()->isAdmin() && $review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        
        $review->delete();
        
        return redirect()->route('reviews.index')
            ->with('success', 'Review deleted successfully!');
    }

    /**
     * Get freelancer reviews (public)
     */
    public function freelancerReviews($freelancerId)
    {
        $freelancer = User::findOrFail($freelancerId);
        
        if (!$freelancer->isFreelancer()) {
            abort(404, 'Freelancer not found');
        }
        
        $reviews = Review::with(['user', 'order'])
            ->where('freelancer_id', $freelancerId)
            ->published()
            ->latest()
            ->paginate(20);
        
        $stats = [
            'average_rating' => $freelancer->average_rating,
            'total_reviews' => $freelancer->total_reviews,
            'breakdown' => $freelancer->reviews_breakdown,
            'distribution' => $freelancer->rating_distribution,
            'detailed' => $freelancer->detailed_average_ratings,
        ];
        
        return view('reviews.freelancer', compact('freelancer', 'reviews', 'stats'));
    }
}