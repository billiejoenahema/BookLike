{{-- スマホ用のフッターメニュー --}}
@if((Auth::check()) && Auth::user()->hasVerifiedEmail())
<div
    id="footer-menu"
    class="
        d-flex
        flex-row
        justify-content-between
        text-reset text-center
        bg-bodyColor
    "
>
    <a
        href="{{ url('reviews') }}"
        id="reviewsIcon"
        class="text-blog footerMenuItem"
        ><i class="fas fa-book-open"></i><br /><span>Reviews</span></a
    >
    <a href="{{ url('users') }}" id="usersIcon" class="text-blog footerMenuItem"
        ><i class="fas fa-users"></i><br /><span>Users</span></a
    >
    <a
        href="{{ url('users/'.$login_user->id) }}"
        id="myPageIcon"
        data-id="{{ $login_user->id }}"
        class="text-blog footerMenuItem"
        ><i class="fas fa-user-cog"></i><br /><span>MyPage</span></a
    >
    <a
        href="#"
        data-toggle="modal"
        data-target="#newPostModal"
        role="button"
        id="newPostIcon"
        class="text-blog footerMenuItem"
        ><i class="fas fa-pen"></i><br /><span>NewPost</span></a
    >
    <a href="#" onclick="{scrollTop}" class="text-blog"
        ><i class="fas fa-angle-up"></i><br /><span>TOP</span></a
    >
</div>
@endauth
