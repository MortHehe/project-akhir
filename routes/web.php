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
use App\Http\Controllers\ChatController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Public freelancer browsing
Route::get('/find-freelancers', [UserController::class, 'findFreelancers'])->name('find-freelancers');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Guest Only)
|--------------------------------------------------------------------------
*/

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

// Logout (requires auth)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Smart Dashboard Redirect
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| User/Client Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    // Find Freelancers
    Route::get('/find-freelancers', [UserController::class, 'findFreelancers'])->name('user.find-freelancers');
    
    // Projects
    Route::get('/projects', [UserController::class, 'projects'])->name('user.projects');
    
    // Orders
    Route::get('/orders', [UserController::class, 'orders'])->name('user.orders');
    
    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::patch('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::patch('/company', [UserController::class, 'updateCompany'])->name('user.company.update');
    
    // Settings
    Route::get('/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::patch('/settings', [UserController::class, 'updateSettings'])->name('user.settings.update');
    Route::patch('/password', [UserController::class, 'updatePassword'])->name('user.password.update');
    Route::patch('/notifications', [UserController::class, 'updateNotifications'])->name('user.notifications.update');
    Route::delete('/account', [UserController::class, 'deleteAccount'])->name('user.account.delete');
    
    // Payments
    Route::get('/payments', [UserController::class, 'payments'])->name('user.payments');
});

/*
|--------------------------------------------------------------------------
| Debug Routes (REMOVE IN PRODUCTION)
|--------------------------------------------------------------------------
*/
// Route::get('/debug-auth', function () {
//     if (Auth::check()) {
//         $user = Auth::user();
//         return response()->json([
//             'authenticated' => true,
//             'user_id' => $user->id,
//             'name' => $user->name,
//             'email' => $user->email,
//             'role' => $user->role,
//             'isFreelancer' => $user->isFreelancer(),
//         ]);
//     }
//     return response()->json(['authenticated' => false]);
// });

// Debug route to test freelancer dashboard without middleware
Route::get('/debug-freelancer', function () {
    return view('freelancer.dashboard');
});

// Debug route WITH middleware to test
Route::get('/debug-with-middleware', function () {
    return response()->json([
        'message' => 'Middleware passed!',
        'user' => Auth::user()->name,
        'role' => Auth::user()->role,
    ]);
})->middleware(['auth', 'role:freelancer']);

/*
|--------------------------------------------------------------------------
| Freelancer Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:freelancer'])->prefix('freelancer')->group(function () {
    // Dashboard
    Route::get('/dashboard', [FreelancerController::class, 'dashboard'])->name('freelancer.dashboard');

    // Orders
    Route::get('/orders', [FreelancerController::class, 'index'])->name('freelancer.index');

    // Profile
    Route::get('/profile', [FreelancerController::class, 'profile'])->name('freelancer.myprofile');
    Route::patch('/profile', [FreelancerController::class, 'updateProfile'])->name('freelancer.myprofile.update');
    Route::post('/skills', [FreelancerController::class, 'updateSkills'])->name('freelancer.skills.update');
    
    // Earnings
    Route::get('/earnings', [FreelancerController::class, 'earnings'])->name('freelancer.earnings');
    Route::post('/withdraw', [FreelancerController::class, 'withdraw'])->name('freelancer.withdraw');
    
    // Settings
    Route::get('/settings', [FreelancerController::class, 'settings'])->name('freelancer.settings');
    Route::patch('/settings', [FreelancerController::class, 'updateSettings'])->name('freelancer.settings.update');
    Route::patch('/password', [FreelancerController::class, 'updatePassword'])->name('freelancer.password.update');
    Route::patch('/notifications', [FreelancerController::class, 'updateNotifications'])->name('freelancer.notifications.update');
    Route::delete('/account', [FreelancerController::class, 'deleteAccount'])->name('freelancer.account.delete');
});

/*
|--------------------------------------------------------------------------
| Order Routes (Shared - Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('orders')->group(function () {
    // View orders (all authenticated users can view)
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');

    // Create orders (only regular users/clients can create orders)
    Route::middleware('role:user')->group(function () {
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');

        // Payment (only order owners can pay)
        Route::get('/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
        Route::post('/{order}/payment', [OrderController::class, 'processPayment'])->name('orders.processPayment');

        // Cancel (only order owners can cancel)
        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    });

    // View individual order (after /create to avoid conflict)
    Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Status Updates (freelancers and clients can update status)
    Route::patch('/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('/{order}/assign', [OrderController::class, 'assignFreelancer'])->name('orders.assignFreelancer');

    // Admin Only
    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('role:admin');
});

/*
|--------------------------------------------------------------------------
| Review Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // View reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
    
    // Mark helpful
    Route::post('/reviews/{review}/helpful', [ReviewController::class, 'markHelpful'])->name('reviews.helpful');
    
    // Create review for order
    Route::get('/orders/{order}/review/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| Public Freelancer Profile & Reviews
|--------------------------------------------------------------------------
*/

// Public freelancer profile view (must be after authenticated freelancer routes)
Route::get('/freelancer/{id}', [FreelancerController::class, 'showProfile'])->name('freelancer.profile');

Route::get('/freelancer/{freelancer}/reviews', [ReviewController::class, 'freelancerReviews'])->name('freelancer.reviews');

/*
|--------------------------------------------------------------------------
| Chat Routes (Auth Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/{user}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/{user}/messages', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::get('/unread/count', [ChatController::class, 'getUnreadCount'])->name('chat.unread');
});

/*
|--------------------------------------------------------------------------
| Admin Routes - Handled by Filament at /admin
|--------------------------------------------------------------------------
*/