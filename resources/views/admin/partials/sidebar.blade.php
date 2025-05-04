<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="position-sticky">
        {{-- <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    Yönetim Paneli
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'admin.job.postings' ? 'active' : '' }}" href="{{ route('admin.job.postings') }}">
                    <i class="bi bi-briefcase"></i>
                    İş İlanları
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/gelen-is-basvurulari') ? 'active' : '' }}" href="{{ route('admin.applications') }}">
                    <i class="bi bi-briefcase"></i>
                    Gelen İş Başvuruları
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'admin.comminication.data' ? 'active' : '' }}" href="{{ route('admin.comminication.data') }}">

                    <i class="bi bi-briefcase"></i>
                    İletişim Form Verileri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/slider/urun/yonetimi') ? 'active' : '' }}" href="{{ route('admin.slider.product.management') }}">
                    <i class="bi bi-briefcase"></i>
                    Slider Ürün Yönetimi
                </a>
            </li>

        </ul> --}}
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    Yönetim Paneli
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/blogs') ? 'active' : '' }}" href="{{ route('admin.blogs') }}">
                    <i class="bi bi-briefcase"></i>
                    Blog/Makale
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/blog-categories') ? 'active' : '' }} {{ request()->is('admin/blog-kategori-olustur') ? 'active' : '' }}" href="{{ route('admin.blog.categories') }}">
                    <i class="bi bi-briefcase"></i>
                    Blog Kategorileri   
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-briefcase"></i>
                   Bölüm/Meslek
                </a>
            </li>

        </ul>
    </div>
</nav>
