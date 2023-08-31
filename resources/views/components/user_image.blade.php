<a href="{{ url('users/' .$user->id) }}">
  <img src="{{ $storage->url($user->profile_image) }}"
    class="rounded-circle shadow-sm" width="48" height="48" loading='lazy' />
</a>
