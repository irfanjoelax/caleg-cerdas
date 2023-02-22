<a class="nav-link {{ Request::is('neighbourhood*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('neighbourhood.index') }}">
    <i class="bi bi-geo-alt"></i>
    <span class="ms-2">Rukun Tetangga</span>
</a>

<a class="nav-link {{ Request::is('voting-place*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('voting-place.index') }}">
    <i class="bi bi-signpost"></i>
    <span class="ms-2">Daftar TPS</span>
</a>

<a class="nav-link {{ Request::is('relawan*') ? 'bg-primary text-white' : '' }}" href="{{ route('relawan.index') }}">
    <i class="bi bi-person-vcard"></i>
    <span class="ms-2">Relawan</span>
</a>

<a class="nav-link {{ Request::is('pendukung*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('pendukung.index') }}">
    <i class="bi bi-person-check"></i>
    <span class="ms-2">Pendukung</span>
</a>
