<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class FreelancerController extends Controller
{
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
            'amount' => 'required|numeric|min:100000', // Minimum 100k IDR
            'bank_account' => 'required|string',
        ]);
        
        $user = Auth::user();
        $availableBalance = $user->total_earnings * 0.85; // 85% after platform fee
        
        if ($validated['amount'] > $availableBalance) {
            return back()->with('error', 'Insufficient balance.');
        }
        
        // Create withdrawal request (you may need a withdrawals table)
        // Withdrawal::create([...]);
        
        return back()->with('success', 'Withdrawal request submitted! Processing time: 1-3 business days.');
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
            'skills' => 'array',
            'skills.*' => 'string|max:50',
        ]);
        
        // Store skills as JSON or in a separate table
        Auth::user()->update(['skills' => json_encode($validated['skills'] ?? [])]);
        
        return back()->with('success', 'Skills updated successfully!');
    }
}
