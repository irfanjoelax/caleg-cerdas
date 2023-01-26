<a class="nav-link {{ Request::is('user*') ? 'bg-primary text-white' : '' }}" href="{{ route('user.index') }}">
    <i class="fa-solid fa-users"></i>
    <span class="ms-2">User {{ $title }}</span>
</a>
