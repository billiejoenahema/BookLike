<a href="{{ url('users/' .$user->id) }}">
@if($user->profile_image == null)
    <img src="{{ $default_image }}" class="rounded-circle shadow-sm" width=50 height="50">
@else
    <img src="{{ asset('storage/profile_image/'.$user->profile_image) }}" class="rounded-circle shadow-sm" width="50" height="50">
@endif
</a>
