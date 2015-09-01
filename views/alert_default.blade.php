<div class="media">
    <div class="media-left">
        <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
    </div>
    <div class="media-body">
        <h6 class="media-heading">{{ $sender->email }} send a message to {{ $receiver->email }}</h6>
        <div class="media-meta">{{ $notification->created_at }}</div>
    </div>
</div>