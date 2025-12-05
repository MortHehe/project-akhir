@extends('layouts.auth')

@section('title', 'Messages')
@section('menu-messages', 'active')

@section('additional-styles')
<style>
    .conversations-list {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 2px solid #f0f0f0;
    }

    .conversation-item {
        display: flex;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid #f0f2f5;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        position: relative;
    }

    .conversation-item:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: translateX(5px);
    }

    .conversation-item:last-child {
        border-bottom: none;
    }

    .conversation-item.unread {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);
        border-left: 4px solid #667eea;
    }

    .conversation-item.unread .conversation-name {
        font-weight: 700;
        color: #667eea;
    }

    .conversation-item.unread .last-message {
        font-weight: 600;
        color: #333;
    }

    .avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 20px;
        margin-right: 15px;
    }

    .conversation-info {
        flex: 1;
        min-width: 0;
    }

    .conversation-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }

    .conversation-name {
        font-weight: 600;
        font-size: 16px;
    }

    .conversation-time {
        font-size: 12px;
        color: #999;
        white-space: nowrap;
        margin-left: 10px;
    }

    .conversation-preview {
        color: #666;
        font-size: 14px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .last-message {
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .unread-badge {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        font-size: 11px;
        font-weight: 700;
        min-width: 24px;
        height: 24px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 8px;
        margin-left: 10px;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #999;
    }

    .empty-state h3 {
        margin-bottom: 15px;
        color: #667eea;
        font-size: 20px;
        font-weight: 700;
    }

    .empty-state p {
        font-size: 15px;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h1>💬 Messages</h1>
        <p>Chat with freelancers and clients</p>
    </div>

    <div class="conversations-list">
        @forelse($conversations as $conversation)
            @php
                // Get last message between these users
                $lastMessage = App\Models\Message::where(function($query) use ($conversation) {
                    $query->where('sender_id', auth()->id())
                          ->where('receiver_id', $conversation->id);
                })->orWhere(function($query) use ($conversation) {
                    $query->where('sender_id', $conversation->id)
                          ->where('receiver_id', auth()->id());
                })->orderBy('created_at', 'desc')->first();

                // Count unread messages from this user
                $unreadCount = App\Models\Message::where('sender_id', $conversation->id)
                    ->where('receiver_id', auth()->id())
                    ->where('is_read', false)
                    ->count();
            @endphp
            <a href="{{ route('chat.show', $conversation->id) }}" class="conversation-item {{ $unreadCount > 0 ? 'unread' : '' }}">
                <div class="avatar">
                    {{ strtoupper(substr($conversation->name, 0, 1)) }}
                </div>
                <div class="conversation-info">
                    <div class="conversation-header">
                        <div class="conversation-name">{{ $conversation->name }}</div>
                        @if($lastMessage)
                            <div class="conversation-time">{{ $lastMessage->created_at->diffForHumans() }}</div>
                        @endif
                    </div>
                    <div class="conversation-preview">
                        <span class="last-message">
                            @if($lastMessage)
                                @if($lastMessage->sender_id === auth()->id())
                                    You:
                                @endif
                                {{ Str::limit($lastMessage->message, 50) }}
                            @else
                                {{ $conversation->role === 'freelancer' ? 'Freelancer' : 'Client' }}
                            @endif
                        </span>
                        @if($unreadCount > 0)
                            <span class="unread-badge">{{ $unreadCount }}</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">
                <h3>No conversations yet</h3>
                <p>Start chatting with freelancers or clients to see your messages here.</p>
            </div>
        @endforelse
    </div>
@endsection
