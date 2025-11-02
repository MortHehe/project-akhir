<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\FreelancerRegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;


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

// Review Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    // Review CRUD
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/orders/{order}/review/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    // Review Actions
    Route::post('/reviews/{review}/helpful', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');
    
    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::patch('/reviews/{review}/verify', [ReviewController::class, 'verify'])->name('reviews.verify');
        Route::patch('/reviews/{review}/toggle-publish', [ReviewController::class, 'togglePublish'])->name('reviews.togglePublish');
    });
});

// Public Routes
Route::get('/freelancer/{freelancer}/reviews', [ReviewController::class, 'freelancerReviews'])->name('freelancer.reviews');


Route::get('/projects', function() {
    return view('projects.index');
})->name('projects.index')->middleware('auth');

Route::get('/orders', function() {
    return view('orders.index');
})->name('orders.index')->middleware('auth');

