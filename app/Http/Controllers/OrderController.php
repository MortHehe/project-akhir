<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for authenticated user
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            // Admin sees all orders
            $orders = Order::with(['user', 'freelancer'])
                ->latest()
                ->paginate(20);
        } elseif ($user->isFreelancer()) {
            // Freelancer sees their assigned orders
            $orders = Order::with(['user'])
                ->where('freelancer_id', $user->id)
                ->orWhere('freelancer_email', $user->email)
                ->latest()
                ->paginate(20);
        } else {
            // User sees their created orders
            $orders = Order::with(['freelancer'])
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(20);
        }
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order
     */
    public function create()
    {
        $freelancers = User::where('role', 'freelancer')->get();
        return view('orders.create', compact('freelancers'));
    }

    /**
     * Store a newly created order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'job_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'freelancer_email' => 'nullable|email',
            'deadline' => 'nullable|date|after:today',
            'requirements' => 'nullable|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'job_title' => $validated['job_title'],
            'job_description' => $validated['job_description'] ?? null,
            'price' => $validated['price'],
            'freelancer_email' => $validated['freelancer_email'] ?? null,
            'deadline' => $validated['deadline'] ?? null,
            'requirements' => $validated['requirements'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified order
     */
    public function show(Order $order)
    {
        // Check authorization
        $user = Auth::user();
        
        if (!$user->isAdmin() && 
            $order->user_id !== $user->id && 
            $order->freelancer_id !== $user->id) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load(['user', 'freelancer']);
        
        return view('orders.show', compact('order'));
    }

    /**
     * Update order status
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,in_progress,completed,cancelled,rejected',
        ]);

        $user = Auth::user();
        
        // Authorization checks
        if ($user->isFreelancer() && $order->freelancer_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
        
        if ($user->isUser() && $order->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        // Update timestamps based on status
        if ($validated['status'] === 'accepted' && !$order->accepted_at) {
            $order->accepted_at = now();
        }
        
        if ($validated['status'] === 'completed' && !$order->completed_at) {
            $order->completed_at = now();
        }

        $order->update(['status' => $validated['status']]);

        return back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Assign freelancer to order
     */
    public function assignFreelancer(Request $request, Order $order)
    {
        $validated = $request->validate([
            'freelancer_id' => 'required|exists:users,id',
        ]);

        $freelancer = User::findOrFail($validated['freelancer_id']);
        
        if (!$freelancer->isFreelancer()) {
            return back()->with('error', 'Selected user is not a freelancer.');
        }

        $order->update([
            'freelancer_id' => $freelancer->id,
            'freelancer_email' => $freelancer->email,
        ]);

        return back()->with('success', 'Freelancer assigned successfully!');
    }

    /**
     * Cancel order
     */
    public function cancel(Order $order)
    {
        $user = Auth::user();
        
        // Only user who created order or admin can cancel
        if (!$user->isAdmin() && $order->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order cancelled successfully!');
    }

    /**
     * Delete order (admin only)
     */
    public function destroy(Order $order)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}