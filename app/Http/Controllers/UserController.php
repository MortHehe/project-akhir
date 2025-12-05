<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    // ==================== SETTINGS ====================
    
    /**
     * Show the settings page
     */
    public function settings()
    {
        return view('user.settings');
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
            'company' => 'nullable|string|max:255',
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
            'project_notifications' => $request->has('project_notifications'),
            'message_notifications' => $request->has('message_notifications'),
            'marketing_emails' => $request->has('marketing_emails'),
        ];
        
        // Store in user settings
        Auth::user()->update(['notification_settings' => json_encode($settings)]);
        
        return back()->with('success', 'Notification preferences updated!');
    }
    
    /**
     * Delete account
     */
    public function deleteAccount()
    {
        $user = Auth::user();
        
        // Check if user has active projects
        $activeProjects = $user->clientOrders()
            ->whereIn('status', ['pending', 'in_progress'])
            ->count();
        
        if ($activeProjects > 0) {
            return back()->with('error', 'Cannot delete account with active projects. Please complete or cancel them first.');
        }
        
        // Logout and delete
        Auth::logout();
        $user->delete();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
    
    // ==================== PAYMENTS ====================

    /**
     * Show the payments page (history only - payment processing via Stripe)
     */
    public function payments()
    {
        return view('user.payments');
    }
    
    // ==================== PROFILE ====================
    
    /**
     * Show the profile page
     */
    public function profile()
    {
        return view('user.profile');
    }
    
    /**
     * Update profile information
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
        ]);
        
        Auth::user()->update($validated);
        
        return back()->with('success', 'Profile updated successfully!');
    }
    
    /**
     * Update company information
     */
    public function updateCompany(Request $request)
    {
        $validated = $request->validate([
            'company' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:100',
            'company_size' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'company_description' => 'nullable|string|max:2000',
        ]);
        
        Auth::user()->update($validated);
        
        return back()->with('success', 'Company information updated successfully!');
    }
    
    /**
     * Dashboard
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }
    
    /**
     * Projects
     */
    public function projects()
    {
        return view('user.projects');
    }

    /**
     * Find freelancers
     */
    public function findFreelancers(Request $request)
    {
        $query = \App\Models\User::where('role', 'freelancer');

        // Search by name or skills
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%")
                  ->orWhere('bio', 'like', "%{$search}%")
                  ->orWhere('skills', 'like', "%{$search}%");
            });
        }

        // Filter by skill
        if ($request->filled('skill')) {
            $query->where('skills', 'like', "%{$request->skill}%");
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Filter by rating
        if ($request->filled('min_rating')) {
            // This would require a more complex query with joins
            // For now, we'll filter in PHP after getting results
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'rating':
                $query->orderByRaw('(SELECT AVG(rating) FROM reviews WHERE reviews.freelancer_id = users.id) DESC NULLS LAST');
                break;
            case 'projects':
                $query->orderByRaw('(SELECT COUNT(*) FROM orders WHERE orders.freelancer_id = users.id AND orders.status = "completed") DESC');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $freelancers = $query->paginate(12)->withQueryString();

        return view('user.find-freelancers', compact('freelancers'));
    }
}
