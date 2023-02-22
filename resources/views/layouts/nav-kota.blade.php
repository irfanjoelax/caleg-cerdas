<a class="nav-link {{ Request::is('district*') ? 'bg-primary text-white' : '' }}" href="{{ route('district.index') }}">
    <i class="bi bi-map"></i>
    <span class="ms-2">Kecamatan</span>
</a>

<a class="nav-link {{ Request::is('pengurus-partai*') ? 'bg-primary text-white' : '' }}"
    href="{{ route('pengurus-partai.index') }}">
    <i class="bi bi-person-badge"></i>
    <span class="ms-2">Pengurus</span>
</a>

<a class="nav-link {{ Request::is('caleg*') ? 'bg-primary text-white' : '' }}" href="{{ route('caleg.index') }}">
    <i class="bi bi-person-workspace"></i>
    <span class="ms-2">Caleg</span>
</a>
