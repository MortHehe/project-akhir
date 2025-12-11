<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class FreelancerController extends Controller
{
    // ==================== DASHBOARD ====================

    /**
     * Show the freelancer dashboard
     */
    public function dashboard()
    {
        return view('freelancer.dashboard');
    }

    /**
     * Show orders list
     */
    public function index()
    {
        return view('freelancer.index');
    }

    /**
     * Browse available jobs/orders
     */
    public function browseJobs()
    {
        $availableOrders = \App\Models\Order::whereNull('freelancer_id')
            ->where('status', 'pending')
            ->with('user')
            ->latest()
            ->paginate(12);

        return view('freelancer.browse-jobs', compact('availableOrders'));
    }

    // ==================== SETTINGS ====================
    
    /**
     * Show the settings page
     */
    public function settings()
    {
        return view('freelancer.settings');
    }
    
    /**
     * Update account settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);
        
        Auth::user()->update($validated);
        
        return back()->with('success', 'Account settings updated successfully!');
    }
    
    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        // Check current password
        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        
        // Update password
        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        
        return back()->with('success', 'Password updated successfully!');
    }
    
    /**
     * Update notification preferences
     */
    public function updateNotifications(Request $request)
    {
        $settings = [
            'email_notifications' => $request->has('email_notifications'),
            'order_notifications' => $request->has('order_notifications'),
            'review_notifications' => $request->has('review_notifications'),
            'marketing_emails' => $request->has('marketing_emails'),
        ];
        
        // Store in user settings (you may need to add a settings column or table)
        Auth::user()->update(['notification_settings' => json_encode($settings)]);
        
        return back()->with('success', 'Notification preferences updated!');
    }
    
    /**
     * Delete account
     */
    public function deleteAccount()
    {
        $user = Auth::user();
        
        // Check if user has pending orders
        $pendingOrders = $user->freelancerOrders()
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();
        
        if ($pendingOrders > 0) {
            return back()->with('error', 'Cannot delete account with pending orders. Please complete or cancel them first.');
        }
        
        // Logout and delete
        Auth::logout();
        $user->delete();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
    
    // ==================== EARNINGS ====================
    
    /**
     * Show the earnings page
     */
    public function earnings()
    {
        return view('freelancer.earnings');
    }
    
    /**
     * Process withdrawal request
     */
    public function withdraw(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:50', // Minimum $50
            'payment_method' => 'required|in:bank_transfer,paypal',
            'payment_details' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $totalEarnings = $user->getTotalEarningsAttribute() ?? 0;

        // Calculate total withdrawals (pending, approved, and sent)
        $totalWithdrawals = $user->withdrawals()
            ->whereIn('status', ['pending', 'approved', 'sent'])
            ->sum('amount') ?? 0;

        // Available balance = (Total earnings * 85%) - Total withdrawals
        $availableBalance = ($totalEarnings * 0.85) - $totalWithdrawals;
        $availableBalance = max(0, $availableBalance); // Ensure it's never negative

        // Check for sufficient balance
        if ($validated['amount'] > $availableBalance) {
            return back()->with('error', 'Insufficient balance. Available: $' . number_format($availableBalance, 2));
        }

        // Check for pending withdrawals
        $pendingWithdrawal = $user->withdrawals()->where('status', 'pending')->first();
        if ($pendingWithdrawal) {
            return back()->with('error', 'You already have a pending withdrawal request. Please wait for it to be processed.');
        }

        // Create withdrawal request
        Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'payment_details' => $validated['payment_details'],
            'status' => 'pending',
            'requested_at' => now(),
        ]);

        return back()->with('success', '✅ Withdrawal request submitted successfully! Your request is pending admin approval. Processing time: 1-3 business days.');
    }
    
    // ==================== PROFILE ====================
    
    /**
     * Show the profile page
     */
    public function profile()
    {
        return view('freelancer.profile');
    }
    
    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:2000',
            'hourly_rate' => 'nullable|numeric|min:0',
        ]);
        
        Auth::user()->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Update skills
     */
    public function updateSkills(Request $request)
    {
        $validated = $request->validate([
            'skills' => 'nullable|string',
        ]);

        // Convert comma-separated string to array
        $skillsString = $validated['skills'] ?? '';
        $skillsArray = array_filter(array_map('trim', explode(',', $skillsString)));

        // Store skills as JSON
        Auth::user()->update(['skills' => json_encode($skillsArray)]);

        return back()->with('success', 'Skills updated successfully!');
    }

    /**
     * Show public freelancer profile
     */
    public function showProfile($id)
    {
        $freelancer = \App\Models\User::where('role', 'freelancer')
            ->where('id', $id)
            ->firstOrFail();

        // Get freelancer's reviews
        $reviews = \App\Models\Review::where('freelancer_id', $id)
            ->where('is_published', true)
            ->latest()
            ->limit(10)
            ->get();

        // Get completed orders count
        $completedOrders = \App\Models\Order::where('freelancer_id', $id)
            ->where('status', 'completed')
            ->count();

        return view('freelancer.public-profile', compact('freelancer', 'reviews', 'completedOrders'));
    }
}
