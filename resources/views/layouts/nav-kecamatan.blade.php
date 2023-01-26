<a class="nav-link {{ Request::is('village*') ? 'bg-primary text-white' : '' }}" href="{{ route('village.index') }}">
    <i class="fa-solid fa-landmark"></i>
    <span class="ms-2">Kelurahan</span>
</a>

<a class="nav-link {{ Request::is('neighbourhood*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('neighbourhood.index') }}">
    <i class="fa-solid fa-house-signal"></i>
    <span class="ms-2">Rukun Tetangga</span>
</a>

<a class="nav-link {{ Request::is('voting-place*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('voting-place.index') }}">
    <i class="fa-solid fa-person-booth"></i>
    <span class="ms-2">Daftar TPS</span>
</a>

<a class="nav-link {{ Request::is('relawan*') ? 'bg-primary text-white' : '' }}" href="{{ route('relawan.index') }}">
    <i class="fa-solid fa-people-arrows"></i>
    <span class="ms-2">Relawan</span>
</a>

<a class="nav-link {{ Request::is('pendukung*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('pendukung.index') }}">
    <i class="fa-solid fa-users-rays"></i>
    <span class="ms-2">Pendukung</span>
</a>

<a class="nav-link {{ Request::is('user*') ? 'bg-primary text-white' : '' }}" href="{{ route('user.index') }}">
    <i class="fa-solid fa-users"></i>
    <span class="ms-2">User Kelurahan</span>
</a>
