@extends('layouts.app')

@section('title', 'Find Freelancers - WORKZY')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-md-block sidebar">
            <div class="sidebar-sticky">
                <div class="text-center py-4">
                    <h3 class="text-white mb-0">WORKZY</h3>
                    <p class="text-white-50 small">Client Dashboard</p>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('freelancers.index') }}">
                            <i class="fas fa-search"></i> Find Freelancers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.projects') }}">
                            <i class="fas fa-folder"></i> My Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.orders') }}">
                            <i class="fas fa-shopping-cart"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.messages') }}">
                            <i class="fas fa-envelope"></i> Messages
                            @if(auth()->user()->unreadMessagesCount() > 0)
                            <span class="badge badge-danger">{{ auth()->user()->unreadMessagesCount() }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.settings') }}">
                            <i class="fas fa-cog"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto px-md-4 main-content">
            <!-- Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <div>
                    <h1 class="h2 gradient-text">Find Freelancers</h1>
                    <p class="text-muted">Discover talented professionals for your projects</p>
                </div>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="dropdown me-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user()->unreadNotifications()->count() > 0)
                            <span class="badge bg-danger">{{ auth()->user()->unreadNotifications()->count() }}</span>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">No new notifications</a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.settings') }}">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('freelancers.index') }}" method="GET" id="searchForm">
                        <div class="row g-3">
                            <!-- Search Input -->
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by name, skill, or expertise..." value="{{ request('search') }}">
                                </div>
                            </div>

                            <!-- Category Filter -->
                            <div class="col-md-3">
                                <select class="form-select" name="category" id="categoryFilter">
                                    <option value="">All Categories</option>
                                    <option value="web-development" {{ request('category') == 'web-development' ? 'selected' : '' }}>Web Development</option>
                                    <option value="mobile-development" {{ request('category') == 'mobile-development' ? 'selected' : '' }}>Mobile Development</option>
                                    <option value="design" {{ request('category') == 'design' ? 'selected' : '' }}>Design</option>
                                    <option value="writing" {{ request('category') == 'writing' ? 'selected' : '' }}>Writing & Content</option>
                                    <option value="marketing" {{ request('category') == 'marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                    <option value="data-science" {{ request('category') == 'data-science' ? 'selected' : '' }}>Data Science</option>
                                </select>
                            </div>

                            <!-- Search Button -->
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-gradient w-100">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>

                        <!-- Advanced Filters -->
                        <div class="row g-3 mt-2">
                            <div class="col-md-3">
                                <label class="form-label small">Rating</label>
                                <select class="form-select" name="rating">
                                    <option value="">Any Rating</option>
                                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Stars</option>
                                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4+ Stars</option>
                                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3+ Stars</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small">Price Range</label>
                                <select class="form-select" name="price_range">
                                    <option value="">Any Price</option>
                                    <option value="budget" {{ request('price_range') == 'budget' ? 'selected' : '' }}>$ (Under $25/hr)</option>
                                    <option value="moderate" {{ request('price_range') == 'moderate' ? 'selected' : '' }}>$$ ($25-$75/hr)</option>
                                    <option value="premium" {{ request('price_range') == 'premium' ? 'selected' : '' }}>$$$ ($75+/hr)</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small">Experience Level</label>
                                <select class="form-select" name="experience">
                                    <option value="">Any Level</option>
                                    <option value="beginner" {{ request('experience') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="intermediate" {{ request('experience') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="expert" {{ request('experience') == 'expert' ? 'selected' : '' }}>Expert</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label small">Sort By</label>
                                <select class="form-select" name="sort" id="sortFilter">
                                    <option value="relevant" {{ request('sort') == 'relevant' ? 'selected' : '' }}>Most Relevant</option>
                                    <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Highest Rated</option>
                                    <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Most Reviews</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Count -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ $freelancers->total() }} Freelancers Found</h5>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="resetFilters()">
                    <i class="fas fa-redo"></i> Reset Filters
                </button>
            </div>

            <!-- Freelancers Grid -->
            <div class="row g-4">
                @forelse($freelancers as $freelancer)
                <div class="col-md-6 col-lg-4">
                    <div class="card freelancer-card h-100 shadow-sm">
                        <div class="card-body">
                            <!-- Profile Header -->
                            <div class="text-center mb-3">
                                <img src="{{ $freelancer->profile_picture ?? 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->name) . '&size=100&background=667eea&color=ffffff' }}" 
                                     alt="{{ $freelancer->name }}" 
                                     class="rounded-circle mb-2" 
                                     width="80" 
                                     height="80">
                                <h5 class="card-title mb-1">{{ $freelancer->name }}</h5>
                                <p class="text-muted small mb-2">{{ $freelancer->title ?? 'Professional Freelancer' }}</p>
                                
                                <!-- Rating -->
                                <div class="rating mb-2">
                                    @php
                                        $avgRating = $freelancer->averageRating();
                                        $fullStars = floor($avgRating);
                                        $halfStar = ($avgRating - $fullStars) >= 0.5;
                                    @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $fullStars)
                                            <i class="fas fa-star text-warning"></i>
                                        @elseif($i == $fullStars + 1 && $halfStar)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    <span class="ms-1 text-muted small">{{ number_format($avgRating, 1) }} ({{ $freelancer->reviewsCount() }})</span>
                                </div>

                                <!-- Stats -->
                                <div class="d-flex justify-content-center gap-3 mb-3">
                                    <div class="text-center">
                                        <small class="text-muted d-block">Completed</small>
                                        <strong>{{ $freelancer->completedProjectsCount() }}</strong>
                                    </div>
                                    <div class="text-center">
                                        <small class="text-muted d-block">Success Rate</small>
                                        <strong>{{ $freelancer->successRate() }}%</strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Bio -->
                            <p class="card-text small text-muted mb-3">
                                {{ Str::limit($freelancer->bio ?? 'Experienced freelancer ready to help with your projects.', 100) }}
                            </p>

                            <!-- Skills -->
                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($freelancer->topSkills(5) as $skill)
                                    <span class="badge bg-light text-dark">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted small">Hourly Rate:</span>
                                <span class="h5 mb-0 gradient-text">${{ number_format($freelancer->hourly_rate ?? 50, 2) }}/hr</span>
                            </div>

                            <!-- Actions -->
                            <div class="d-grid gap-2">
                                <a href="{{ route('freelancers.show', $freelancer->id) }}" class="btn btn-gradient">
                                    <i class="fas fa-eye"></i> View Profile
                                </a>
                                <a href="{{ route('messages.create', $freelancer->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope"></i> Message
                                </a>
                            </div>

                            <!-- Badges -->
                            <div class="mt-3 d-flex gap-2 flex-wrap">
                                @if($freelancer->is_verified)
                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Verified</span>
                                @endif
                                @if($freelancer->is_top_rated)
                                <span class="badge bg-warning text-dark"><i class="fas fa-star"></i> Top Rated</span>
                                @endif
                                @if($freelancer->is_online)
                                <span class="badge bg-success"><i class="fas fa-circle"></i> Online</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>No Freelancers Found</h4>
                            <p class="text-muted">Try adjusting your search filters or search criteria</p>
                            <button type="button" class="btn btn-gradient mt-3" onclick="resetFilters()">
                                Reset Filters
                            </button>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($freelancers->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $freelancers->links() }}
            </div>
            @endif
        </main>
    </div>
</div>

<style>
/* Sidebar Styling */
.sidebar {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    padding: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
}

.sidebar-sticky {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-x: hidden;
    overflow-y: auto;
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.8);
    padding: 12px 20px;
    margin: 5px 15px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    color: white;
    background: rgba(255, 255, 255, 0.2);
}

.sidebar .nav-link i {
    margin-right: 10px;
    width: 20px;
}

/* Main Content */
.main-content {
    margin-left: 16.66667%;
    padding-top: 20px;
    min-height: 100vh;
    background: #f8f9fa;
}

/* Gradient Text */
.gradient-text {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
}

/* Gradient Button */
.btn-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
}

/* Freelancer Card */
.freelancer-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 12px;
}

.freelancer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.freelancer-card img {
    border: 3px solid #667eea;
    object-fit: cover;
}

/* Rating Stars */
.rating i {
    font-size: 0.9rem;
}

/* Badge Styling */
.badge {
    padding: 5px 10px;
    font-weight: 500;
}

/* Input Focus */
.form-control:focus,
.form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Card Hover Effect */
.card {
    transition: all 0.3s ease;
    border: none;
}

.card:hover {
    box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        position: relative;
        height: auto;
    }
    
    .main-content {
        margin-left: 0;
    }
}
</style>

<script>
// Auto-submit form on filter change
document.querySelectorAll('#categoryFilter, #sortFilter').forEach(element => {
    element.addEventListener('change', function() {
        document.getElementById('searchForm').submit();
    });
});

// Reset filters function
function resetFilters() {
    window.location.href = '{{ route("freelancers.index") }}';
}

// Show loading state on form submit
document.getElementById('searchForm').addEventListener('submit', function() {
    const button = this.querySelector('button[type="submit"]');
    button.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Searching...';
    button.disabled = true;
});
</script>
@endsection