@extends('layouts.auth')

@section('title', 'Browse Available Jobs')
@section('menu-dashboard', 'active')

@section('additional-styles')
<style>
    .jobs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .job-card {
        background: white;
        border: 2px solid #f0f0f0;
        border-radius: 16px;
        padding: 25px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .job-card:hover {
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        transform: translateY(-5px);
    }

    .job-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 15px;
    }

    .job-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .job-price {
        font-size: 24px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .job-description {
        color: #666;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .job-meta {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #999;
    }

    .job-client {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 15px;
        border-top: 2px solid #f0f0f0;
        margin-bottom: 15px;
    }

    .client-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 14px;
    }

    .client-info {
        flex: 1;
    }

    .client-name {
        font-weight: 600;
        font-size: 14px;
        color: #1a1a1a;
    }

    .client-label {
        font-size: 12px;
        color: #999;
    }

    .job-actions {
        display: flex;
        gap: 10px;
    }

    .btn-view {
        flex: 1;
        padding: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        text-decoration: none;
        display: block;
    }

    .btn-view:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>🔍 Browse Available Jobs</h1>
        <p>Find projects looking for talented freelancers like you</p>
    </div>

    @if($availableOrders->count() > 0)
        <div class="jobs-grid">
            @foreach($availableOrders as $order)
                <div class="job-card" onclick="window.location.href='{{ route('orders.show', $order) }}'">
                    <div class="job-header">
                        <div>
                            <div class="job-title">{{ $order->job_title }}</div>
                        </div>
                        <div class="job-price">${{ number_format($order->price, 2) }}</div>
                    </div>

                    <div class="job-description">
                        {{ $order->job_description }}
                    </div>

                    <div class="job-meta">
                        <div class="meta-item">
                            📅 Posted {{ $order->created_at->diffForHumans() }}
                        </div>
                        @if($order->deadline)
                            <div class="meta-item">
                                ⏰ Deadline: {{ \Carbon\Carbon::parse($order->deadline)->format('M d, Y') }}
                            </div>
                        @endif
                    </div>

                    <div class="job-client">
                        <div class="client-avatar">
                            {{ strtoupper(substr($order->user->name ?? 'C', 0, 1)) }}
                        </div>
                        <div class="client-info">
                            <div class="client-name">{{ $order->user->name ?? 'Client' }}</div>
                            <div class="client-label">Project Client</div>
                        </div>
                    </div>

                    <div class="job-actions">
                        <a href="{{ route('orders.show', $order) }}" class="btn-view" onclick="event.stopPropagation()">
                            View Details →
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="margin-top: 40px;">
            {{ $availableOrders->links() }}
        </div>
    @else
        <div class="card">
            <div class="empty-state">
                <h3>😊 No available jobs right now</h3>
                <p style="color: #666; margin-bottom: 20px;">Check back later for new opportunities</p>
                <button class="btn btn-secondary" onclick="window.location.href='{{ route('freelancer.dashboard') }}'">
                    Back to Dashboard
                </button>
            </div>
        </div>
    @endif
@endsection
