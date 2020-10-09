<div class="ml-3">
    @if ($is_following)
    <form action="{{ route('unfollow', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-sm btn-blog rounded-pill shadow-sm border-0">フォロー中</button>
    </form>
    @else
    <form action="{{ route('follow', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-sm btn-outline-blog rounded-pill shadow-sm border-0">フォローする</button>
    </form>
    @endif
</div>
