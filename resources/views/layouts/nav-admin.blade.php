 <a class="nav-link collapsed {{ Request::is('area/*') ? 'bg-primary text-white' : '' }}" href="#"
     data-bs-toggle="collapse" data-bs-target="#collapseWilayah" aria-expanded="false" aria-controls="collapseWilayah">
     <div class="sb-nav-link-icon">
         <i class="fa-solid fa-map-location-dot"></i>
     </div>
     Wilayah
     <div class="sb-sidenav-collapse-arrow">
         <i class="fas fa-angle-down"></i>
     </div>
 </a>
 <div class="collapse" id="collapseWilayah" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
     <nav class="sb-sidenav-menu-nested nav">
         <a class="nav-link" href="{{ route('province.index') }}">
             Provinsi
         </a>
         <a class="nav-link" href="{{ route('regency.index') }}">
             Kota/Kabupaten
         </a>
         <a class="nav-link" href="{{ route('district.index') }}">
             Kecamatan
         </a>
         <a class="nav-link" href="{{ route('village.index') }}">
             Kelurahan
         </a>
         <a class="nav-link" href="{{ route('neighbourhood.index') }}">
             Rukun Tetangga
         </a>
     </nav>
 </div>
 <a class="nav-link {{ (Request::is('pengurus-partai') or Request::is('pengurus-partai/*')) ? 'bg-primary text-white' : '' }}"
     href="{{ route('pengurus-partai.index') }}">
     <i class="fa-solid fa-sitemap"></i>
     <span class="ms-2">Pengurus Partai</span>
 </a>
