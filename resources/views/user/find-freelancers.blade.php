<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Freelancers - WORKZY</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        /* Navigation */
        nav {
            background: white;
            padding: 20px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links a {
            margin-left: 30px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #667eea;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 60px 60px 40px;
            color: white;
        }

        .page-header h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .page-header p {
            font-size: 18px;
            opacity: 0.95;
        }

        /* Search & Filters */
        .search-filters {
            background: white;
            padding: 30px 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .search-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .search-bar input {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-bar button {
            padding: 15px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .search-bar button:hover {
            transform: translateY(-2px);
        }

        .filters {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .filter-group label {
            font-size: 14px;
            color: #666;
            font-weight: 500;
        }

        .filter-group select,
        .filter-group input {
            padding: 10px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 14px;
            min-width: 180px;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .filter-actions {
            display: flex;
            gap: 10px;
            margin-left: auto;
        }

        .btn-filter {
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-filter:hover {
            background: #5568d3;
        }

        .btn-clear {
            padding: 10px 20px;
            background: transparent;
            color: #666;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-clear:hover {
            border-color: #667eea;
            color: #667eea;
        }

        /* Results Section */
        .results-section {
            padding: 40px 60px;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .results-count {
            font-size: 18px;
            color: #666;
        }

        .results-count strong {
            color: #333;
            font-weight: 700;
        }

        .sort-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sort-dropdown label {
            font-size: 14px;
            color: #666;
        }

        .sort-dropdown select {
            padding: 8px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            font-size: 14px;
        }

        /* Freelancer Grid */
        .freelancers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .freelancer-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .freelancer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .freelancer-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .freelancer-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 28px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .freelancer-basic {
            flex: 1;
        }

        .freelancer-name {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .freelancer-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .freelancer-location {
            font-size: 13px;
            color: #999;
        }

        .freelancer-bio {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .freelancer-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }

        .skill-tag {
            padding: 5px 12px;
            background: #f0f4ff;
            color: #667eea;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
        }

        .freelancer-stats {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 15px;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .freelancer-actions {
            display: flex;
            gap: 10px;
        }

        .btn-view {
            flex: 1;
            padding: 12px;
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-view:hover {
            background: #667eea;
            color: white;
        }

        .btn-hire {
            flex: 1;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn-hire:hover {
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state-icon {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .empty-state p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .btn-reset {
            padding: 12px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: white;
            border: 2px solid #e1e8ed;
            border-radius: 6px;
            color: #666;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination a:hover {
            border-color: #667eea;
            color: #667eea;
        }

        .pagination .active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: transparent;
        }

        .pagination .disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            padding: 40px 60px;
            margin-top: 60px;
            text-align: center;
        }

        footer p {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">WORKZY</div>
        <div class="nav-links">
            <a href="{{ route('welcome') }}">Home</a>
            <a href="{{ route('find-freelancers') }}">Find Freelancers</a>
            @auth
                <a href="{{ route('user.dashboard') }}">Dashboard</a>
                <a href="{{ route('chat.index') }}">Messages</a>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Sign Up</a>
            @endauth
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Find Top Freelancers</h1>
        <p>Browse thousands of talented professionals ready to work on your project</p>
    </div>

    <!-- Search & Filters -->
    <div class="search-filters">
        <form method="GET" action="{{ route('find-freelancers') }}">
            <div class="search-bar">
                <input type="text" name="search" placeholder="Search by name, skills, or expertise..." value="{{ request('search') }}">
                <button type="submit">🔍 Search</button>
            </div>

            <div class="filters">
                <div class="filter-group">
                    <label>Skill/Service</label>
                    <input type="text" name="skill" placeholder="e.g. Web Development" value="{{ request('skill') }}">
                </div>

                <div class="filter-group">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="Any location" value="{{ request('location') }}">
                </div>

                <div class="filter-group">
                    <label>Sort By</label>
                    <select name="sort" onchange="this.form.submit()">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Highest Rated</option>
                        <option value="projects" {{ request('sort') === 'projects' ? 'selected' : '' }}>Most Projects</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                    </select>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">Apply Filters</button>
                    <a href="{{ route('find-freelancers') }}" class="btn-clear">Clear All</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Results Section -->
    <div class="results-section">
        <div class="results-header">
            <div class="results-count">
                Found <strong>{{ $freelancers->total() }}</strong> freelancers
                @if(request('search') || request('skill') || request('location'))
                    matching your criteria
                @endif
            </div>
        </div>

        @if($freelancers->count() > 0)
            <!-- Freelancers Grid -->
            <div class="freelancers-grid">
                @foreach($freelancers as $freelancer)
                    <div class="freelancer-card">
                        <div class="freelancer-header">
                            <div class="freelancer-avatar">
                                {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                            </div>
                            <div class="freelancer-basic">
                                <div class="freelancer-name">{{ $freelancer->name }}</div>
                                <div class="freelancer-title">{{ $freelancer->title ?? 'Professional Freelancer' }}</div>
                                <div class="freelancer-location">📍 {{ $freelancer->location ?? 'Remote' }}</div>
                            </div>
                        </div>

                        @if($freelancer->bio)
                            <div class="freelancer-bio">
                                {{ $freelancer->bio }}
                            </div>
                        @endif

                        @if($freelancer->skills)
                            <div class="freelancer-skills">
                                @php
                                    $skills = is_string($freelancer->skills) ? explode(',', $freelancer->skills) : $freelancer->skills;
                                @endphp
                                @foreach(array_slice($skills, 0, 4) as $skill)
                                    <span class="skill-tag">{{ trim($skill) }}</span>
                                @endforeach
                                @if(count($skills) > 4)
                                    <span class="skill-tag">+{{ count($skills) - 4 }} more</span>
                                @endif
                            </div>
                        @endif

                        <div class="freelancer-stats">
                            <div class="stat">
                                <div class="stat-value">{{ number_format($freelancer->getAverageRatingAttribute(), 1) }}</div>
                                <div class="stat-label">Rating</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">{{ $freelancer->freelancerOrders()->where('status', 'completed')->count() }}</div>
                                <div class="stat-label">Projects</div>
                            </div>
                            <div class="stat">
                                <div class="stat-value">{{ $freelancer->getTotalReviewsAttribute() }}</div>
                                <div class="stat-label">Reviews</div>
                            </div>
                        </div>

                        <div class="freelancer-actions">
                            @auth
                                <button class="btn-view" onclick="window.location='{{ route('freelancer.profile', $freelancer->id) }}'">View Profile</button>
                                <button class="btn-hire" onclick="window.location='{{ route('orders.create') }}?freelancer_id={{ $freelancer->id }}'">Hire Now</button>
                            @else
                                <button class="btn-view" onclick="window.location='{{ route('login') }}'">View Profile</button>
                                <button class="btn-hire" onclick="window.location='{{ route('login') }}'">Hire Now</button>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                @if ($freelancers->onFirstPage())
                    <span class="disabled">« Previous</span>
                @else
                    <a href="{{ $freelancers->previousPageUrl() }}">« Previous</a>
                @endif

                @foreach ($freelancers->getUrlRange(1, $freelancers->lastPage()) as $page => $url)
                    @if ($page == $freelancers->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($freelancers->hasMorePages())
                    <a href="{{ $freelancers->nextPageUrl() }}">Next »</a>
                @else
                    <span class="disabled">Next »</span>
                @endif
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h3>No freelancers found</h3>
                <p>Try adjusting your search criteria or filters to find more results</p>
                <a href="{{ route('find-freelancers') }}" class="btn-reset">Reset Filters</a>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 WORKZY. All rights reserved.</p>
    </footer>
</body>
</html>
