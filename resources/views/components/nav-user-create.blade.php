<a class="nav-link {{ Request::is('user*') ? 'bg-primary text-white' : '' }}" href="{{ route('user.index') }}">
    <i class="bi bi-people"></i>
    <span class="ms-2">{{ $title }}</span>
</a>
