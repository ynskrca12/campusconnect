<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!-- Logo ve Başlık -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logos/light_logo_cropped.png') }}" alt="logo" style="height: 40px; margin-right: 10px;">
        </a>

        <!-- Hamburger Menü Butonu (Mobil için) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menü -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link" style="color: #001b48;">Hoşgeldiniz</span>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" 
                        style="color: #fff;background: #001b48;padding: 8px 30px;border-radius: 11px;" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Çıkış</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
