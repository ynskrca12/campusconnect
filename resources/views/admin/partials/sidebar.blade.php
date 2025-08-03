<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="position-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-house-door"></i>
                    Yönetim Paneli
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                    <i class="bi bi-briefcase"></i>
                    Kullanıcılar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/university-comments') ? 'active' : '' }}" href="{{ route('admin.university.comments') }}">
                    <i class="bi bi-briefcase"></i>
                    Üniversite Yorumları
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/city-comments') ? 'active' : '' }}" href="{{ route('admin.city.comments') }}">
                    <i class="bi bi-briefcase"></i>
                    Şehir Yorumları
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/general-comments') ? 'active' : '' }}" href="{{ route('admin.general.comments') }}">
                    <i class="bi bi-briefcase"></i>
                    Genel Yorumlar
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

<!-- Mobil Sidebar -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileSidebarLabel">Yönetim Paneli</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Kapat"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-house-door"></i> Yönetim Paneli
        </a>
      </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                <i class="bi bi-briefcase"></i>
                Kullanıcılar
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('admin/university-comments') ? 'active' : '' }}" href="{{ route('admin.university.comments') }}">
                <i class="bi bi-briefcase"></i>
                Üniversite Yorumları
            </a>
        </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/blogs') ? 'active' : '' }}" href="{{ route('admin.blogs') }}">
            <i class="bi bi-briefcase"></i> Blog/Makale
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/blog-categories') ? 'active' : '' }} {{ request()->is('admin/blog-kategori-olustur') ? 'active' : '' }}" href="{{ route('admin.blog.categories') }}">
            <i class="bi bi-briefcase"></i> Blog Kategorileri
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="bi bi-briefcase"></i> Bölüm/Meslek
        </a>
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

