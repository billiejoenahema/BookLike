<footer class="page-footer bg-imageColor font-small w-100">
    <div class="footer-copyright d-flex flex-wrap flex-row justify-content-center text-dark py-3"
        style="box-shadow: 0 -2px 4px #eee;">
        <a class="text-reset px-2 internal-link" href="{{ url('/reviews') }}">© 2020 Copyright: BookLike</a>
        <div class="px-2">
            <a class="text-reset small px-2 internal-link" href="{{ url('/terms') }}">利用規約</a>
            <a class="text-reset small px-2 internal-link" href="{{ url('/privacy') }}">プライバシーポリシー</a>
        </div>

    </div>
</footer>

{{-- Footer Menu for mobile --}}
@auth
<div id="footer-menu" class="d-flex flex-row justify-content-between text-reset text-center bg-bodyColor">
    <a href="{{ url('reviews') }}" id="reviewsIcon" class="text-blog footerMenuItem"><i
            class="fas fa-book-open"></i><br /><span>Reviews</span></a>
    <a href="{{ url('users') }}" id="usersIcon" class="text-blog footerMenuItem"><i
            class="fas fa-users"></i><br /><span>Users</span></a>
    <a href="{{ url('users/'.$login_user->id) }}" id="myPageIcon" data-id="{{ $login_user->id }}"
        class="text-blog footerMenuItem"><i class="fas fa-user-cog"></i><br /><span>MyPage</span></a>
    <a href="#" data-toggle="modal" data-target="#newPostModal" role="button" id="newPostIcon"
        class="text-blog footerMenuItem"><i class="fas fa-pen"></i><br /><span>NewPost</span></a>
    <a href="#" onclick="{scrollTop}" class="text-blog"><i class="fas fa-angle-up"></i><br /><span>TOP</span></a>
</div>
@endauth
