<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\FreelancerRegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;



// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes (public - for guests only)
Route::middleware('guest')->group(function () {
    // Client Registration
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    // Freelancer Registration
    Route::get('/register/freelancer', [FreelancerRegisterController::class, 'showRegistrationForm'])->name('freelancer.register.form');
    Route::post('/register/freelancer', [FreelancerRegisterController::class, 'register'])->name('freelancer.register');
    
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// Logout route (requires authentication)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Smart dashboard redirect route
Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    if (Auth::user()->isAdmin()) {
        return redirect('/admin');
    }
    
    if (Auth::user()->isFreelancer()) {
        return redirect()->route('freelancer.dashboard');
    }
    
    return redirect()->route('user.dashboard');
})->name('dashboard');

// User Dashboard (protected, only for authenticated users with role='user')
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    
    Route::get('/user/profile', function () {
        return view('user.profile');
    })->name('user.profile');
});

// Freelancer Dashboard (protected, only for authenticated freelancers with role='freelancer')
Route::middleware(['auth', 'role:freelancer'])->group(function () {
    Route::get('/freelancer/dashboard', function () {
        return view('freelancer.dashboard');
    })->name('freelancer.dashboard');
    
    Route::get('/freelancer/profile', function () {
        return view('freelancer.profile');
    })->name('freelancer.profile');
    
    Route::get('/freelancer/jobs', function () {
        return view('freelancer.jobs');
    })->name('freelancer.jobs');
});

// Admin routes are handled by Filament at /admin
// Filament automatically protects these routes with authentication

// Order Management Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    // Orders CRUD
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    
    // Order Status Updates
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('/orders/{order}/assign', [OrderController::class, 'assignFreelancer'])->name('orders.assignFreelancer');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    
    // Admin Only
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy')
        ->middleware('role:admin');
});


// Review routes for freelancers
Route::middleware(['auth'])->group(function () {
    
    // View all reviews (for freelancers)
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    
    // View single review
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    
    // Mark review as helpful
    Route::post('/reviews/{review}/helpful', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');
    
    // Create review (for clients)
    Route::get('/orders/{order}/review/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');
});


Route::middleware(['auth'])->group(function () {
    
    // ==================== USER/CLIENT DASHBOARD ====================
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/projects', [UserController::class, 'projects'])->name('user.projects');
    Route::get('/user/find-freelancers', [UserController::class, 'findFreelancers'])->name('user.find-freelancers');
    
    // ==================== SETTINGS ====================
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::patch('/user/settings', [UserController::class, 'updateSettings'])->name('user.settings.update');
    Route::patch('/user/password', [UserController::class, 'updatePassword'])->name('user.password.update');
    Route::patch('/user/notifications', [UserController::class, 'updateNotifications'])->name('user.notifications.update');
    Route::delete('/user/account', [UserController::class, 'deleteAccount'])->name('user.account.delete');
    
    // ==================== PAYMENTS ====================
    Route::get('/user/payments', [UserController::class, 'payments'])->name('user.payments');
    Route::post('/user/payment-method', [UserController::class, 'addPaymentMethod'])->name('user.payment.add');
    Route::delete('/user/payment-method/{id}', [UserController::class, 'removePaymentMethod'])->name('user.payment.remove');
    
    // ==================== PROFILE ====================
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::patch('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::patch('/user/company', [UserController::class, 'updateCompany'])->name('user.company.update');
    
});


Route::middleware(['auth'])->group(function () {
    
    // ==================== SETTINGS ====================
    Route::get('/freelancer/settings', [FreelancerController::class, 'settings'])->name('freelancer.settings');
    Route::patch('/freelancer/settings', [FreelancerController::class, 'updateSettings'])->name('freelancer.settings.update');
    Route::patch('/freelancer/password', [FreelancerController::class, 'updatePassword'])->name('freelancer.password.update');
    Route::patch('/freelancer/notifications', [FreelancerController::class, 'updateNotifications'])->name('freelancer.notifications.update');
    Route::delete('/freelancer/account', [FreelancerController::class, 'deleteAccount'])->name('freelancer.account.delete');
    
    // ==================== EARNINGS ====================
    Route::get('/freelancer/earnings', [FreelancerController::class, 'earnings'])->name('freelancer.earnings');
    Route::post('/freelancer/withdraw', [FreelancerController::class, 'withdraw'])->name('freelancer.withdraw');
    
    // ==================== PROFILE ====================
    Route::get('/freelancer/profile', [FreelancerController::class, 'profile'])->name('freelancer.profile');
    Route::patch('/freelancer/profile', [FreelancerController::class, 'updateProfile'])->name('freelancer.profile.update');
    Route::post('/freelancer/skills', [FreelancerController::class, 'updateSkills'])->name('freelancer.skills.update');
    
});

// Public Routes
Route::get('/freelancer/{freelancer}/reviews', [ReviewController::class, 'freelancerReviews'])->name('freelancer.index');


Route::get('/projects', function() {
    return view('user.projects');
})->name('user.projects')->middleware('auth');

Route::get('/orders', function() {
    return view('freelancer.index');
})->name('freelancer.index')->middleware('auth');

