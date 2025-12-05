@extends('layouts.auth')

@section('title', 'Chat with ' . $otherUser->name)
@section('menu-messages', 'active')

@section('additional-styles')
<style>
    /* Override main content padding for full-height chat */
    .main-content {
        padding: 0 !important;
        height: calc(100vh - 80px);
        display: flex;
        flex-direction: column;
    }

    .chat-wrapper {
        height: 100%;
        display: flex;
        flex-direction: column;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .chat-header {
        background: white;
        padding: 20px 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid #f0f0f0;
    }

    .chat-header-info {
        display: flex;
        align-items: center;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 20px;
        margin-right: 15px;
        position: relative;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .avatar .status-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #4CAF50;
        border: 3px solid white;
    }

    .avatar .status-indicator.offline {
        background: #999;
    }

    .user-info h2 {
        font-size: 18px;
        margin-bottom: 3px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .user-info p {
        font-size: 13px;
        color: #999;
        font-weight: 600;
    }

    .btn-back {
        padding: 10px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .messages-container {
        flex: 1;
        overflow-y: auto;
        padding: 30px;
        background: #f5f7fa;
    }

    .message {
        margin-bottom: 20px;
        display: flex;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .message.sent {
        justify-content: flex-end;
    }

    .message-content {
        max-width: 60%;
        padding: 14px 20px;
        border-radius: 18px;
        word-wrap: break-word;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .message.received .message-content {
        background: white;
        color: #333;
        border-bottom-left-radius: 4px;
    }

    .message.sent .message-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-bottom-right-radius: 4px;
    }

    .message-time {
        font-size: 11px;
        margin-top: 5px;
        opacity: 0.7;
        font-weight: 600;
    }

    .message.received .message-time {
        text-align: left;
    }

    .message.sent .message-time {
        text-align: right;
    }

    .message-input-container {
        background: white;
        padding: 20px 30px;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.05);
        border-top: 2px solid #f0f0f0;
    }

    .message-form {
        display: flex;
        gap: 15px;
    }

    .message-input {
        flex: 1;
        padding: 14px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 14px;
        outline: none;
        transition: all 0.3s;
        font-weight: 600;
    }

    .message-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-send {
        padding: 14px 35px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-send:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-send:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }

    .empty-state {
        text-align: center;
        color: #999;
        padding: 60px 20px;
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #666;
    }

    .empty-state p {
        font-size: 15px;
        color: #999;
    }

    @media (max-width: 768px) {
        .message-content {
            max-width: 80%;
        }
    }
</style>
@endsection

@section('content')
    <div class="chat-wrapper">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="avatar">
                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                    <span class="status-indicator" title="Online"></span>
                </div>
                <div class="user-info">
                    <h2>{{ $otherUser->name }}</h2>
                    <p>{{ $otherUser->role === 'freelancer' ? 'Freelancer' : 'Client' }}</p>
                </div>
            </div>
            <a href="{{ route('chat.index') }}" class="btn-back">← Back to Messages</a>
        </div>

        <div class="messages-container" id="messagesContainer">
            @forelse($messages as $message)
                <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}" data-message-id="{{ $message->id }}">
                    <div class="message-content">
                        {{ $message->message }}
                        <div class="message-time">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon">💬</div>
                    <h3>No messages yet</h3>
                    <p>Start the conversation!</p>
                </div>
            @endforelse
        </div>

        <div class="message-input-container">
            <form class="message-form" id="messageForm">
                @csrf
                <input
                    type="text"
                    class="message-input"
                    id="messageInput"
                    placeholder="Type your message..."
                    autocomplete="off"
                    required
                >
                <button type="submit" class="btn-send" id="sendButton">Send</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const userId = {{ $otherUser->id }};
    const currentUserId = {{ Auth::id() }};
    let lastMessageId = {{ $messages->last()->id ?? 0 }};
    let isPolling = true;

    // CSRF Token setup
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // Elements
    const messageForm = document.getElementById('messageForm');
    const messageInput = document.getElementById('messageInput');
    const messagesContainer = document.getElementById('messagesContainer');
    const sendButton = document.getElementById('sendButton');

    // Send message
    messageForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (!message) return;

        sendButton.disabled = true;

        try {
            const response = await fetch(`/chat/${userId}/send`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();

            if (data.success) {
                messageInput.value = '';
                addMessage(data.message, true);
                lastMessageId = data.message.id;
                scrollToBottom();
            }
        } catch (error) {
            console.error('Error sending message:', error);
            alert('Failed to send message. Please try again.');
        } finally {
            sendButton.disabled = false;
            messageInput.focus();
        }
    });

    // Poll for new messages
    async function pollMessages() {
        if (!isPolling) return;

        try {
            const response = await fetch(`/chat/${userId}/messages?last_message_id=${lastMessageId}`);
            const data = await response.json();

            if (data.messages && data.messages.length > 0) {
                let hasNewMessages = false;
                data.messages.forEach(message => {
                    const added = addMessage(message, message.sender_id === currentUserId);
                    if (added !== false) {
                        hasNewMessages = true;
                        if (message.id > lastMessageId) {
                            lastMessageId = message.id;
                        }
                    }
                });

                if (hasNewMessages) {
                    scrollToBottom();
                }
            }
        } catch (error) {
            console.error('Error polling messages:', error);
        }

        setTimeout(pollMessages, 2000);
    }

    // Add message to UI
    function addMessage(message, isSent) {
        const existingMessage = messagesContainer.querySelector(`[data-message-id="${message.id}"]`);
        if (existingMessage) {
            return false;
        }

        const emptyState = messagesContainer.querySelector('.empty-state');
        if (emptyState) {
            emptyState.remove();
        }

        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isSent ? 'sent' : 'received'}`;
        messageDiv.setAttribute('data-message-id', message.id);

        const time = new Date(message.created_at).toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        });

        messageDiv.innerHTML = `
            <div class="message-content">
                ${escapeHtml(message.message)}
                <div class="message-time">${time}</div>
            </div>
        `;

        messagesContainer.appendChild(messageDiv);
        return true;
    }

    // Scroll to bottom
    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Initialize
    scrollToBottom();
    pollMessages();

    // Stop polling when leaving page
    window.addEventListener('beforeunload', () => {
        isPolling = false;
    });
</script>
@endsection
