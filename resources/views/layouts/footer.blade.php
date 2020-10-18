<footer class="page-footer bg-imageColor font-small">
    <div class="footer-copyright text-center text-blog py-3" style="box-shadow: 0 -2px 4px #eee;">© 2020 Copyright:
        <a class="text-reset" href="{{ url('/') }}">BookLike</a>
    </div>
</footer>
@auth
<div id="footer-menu" class="d-flex flex-row justify-content-between text-reset text-center bg-bodyColor">
    <a href="{{ url('reviews') }}" class="text-blog"><i class="fas fa-book-open"></i><br /><span>Reviews</span></a>
    <a href="{{ url('users') }}" class="text-blog"><i class="fas fa-users"></i><br /><span>Users</span></a>
    <a href="{{ url('users/'.$login_user->id) }}" class="text-blog"><i
            class="fas fa-user-cog"></i><br /><span>MyPage</span></a>
    <a href="{{ url('reviews/create') }}" class="text-blog"><i class="fas fa-pen"></i><br /><span>NewPost</span></a>
    <a href="#" onclick="{scrollTop}" class="text-blog"><i class="fas fa-angle-up"></i><br /><span>TOP</span></a>
</div>
@endauth
