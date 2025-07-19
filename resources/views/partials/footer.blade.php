<footer class="footer mt-auto pt-5 pb-4" style="background-color: #f8f9fa; color: #343a40; border-top: 1px solid #dee2e6;">
  <div class="container">
    <div class="row align-items-start">
      <div class="col-md-3 mb-4">
        <a href="{{ route('home') }}">
          <img src="{{ asset('assets/images/logos/light_logo_cropped-removebg.png') }}" alt="CampusConnect Logo" style="height: 40px;">
        </a>
        <p class="mt-4" style="font-size: 0.95rem;">
          Türkiye'deki üniversiteler hakkında güncel öğrenci yorumlarını inceleyin.
        </p>
      </div>

      <div class="col-6 col-md-3 mb-4">
        <h6 class="fw-bold">Neler Sunuyoruz?</h6>
        <ul class="list-unstyled small">
          <li><a href="javasscript:void(0);" class="text-decoration-none text-dark">Üniversite Yorumları</a></li>
          <li><a href="javasscript:void(0);" class="text-decoration-none text-dark">Üniversite Bölümleri</a></li>
          <li><a href="javasscript:void(0);" class="text-decoration-none text-dark">Forumlar</a></li>
          <li><a href="javasscript:void(0);" class="text-decoration-none text-dark">Şehirleri Tanı</a></li> 
        </ul>
      </div>

      <div class="col-6 col-md-3 mb-4">
        <h6 class="fw-bold">Site Haritası</h6>
        <ul class="list-unstyled small">
          <li><a href="{{ route('home') }}" class="text-decoration-none text-dark">Anasayfa</a></li>
          <li><a href="{{ route('about.us') }}" class="text-decoration-none text-dark">Hakkımızda</a></li>
          <li><a href="{{ route('services') }}" class="text-decoration-none text-dark">Hizmetler</a></li>
          <li><a href="{{ route('contact.us') }}" class="text-decoration-none text-dark">İletişim</a></li>
          <li><a href="{{ route('workspace.index') }}" class="text-decoration-none text-dark">Çalışma Alanı</a></li>
        </ul>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold">Bizi Takip Edin</h6>
        <ul class="list-inline mt-2">
          <li class="list-inline-item">
            <a href="https://x.com/iletisimcc" target="_blank" class="text-dark fs-5">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="https://instagram.com" target="_blank" class="text-dark fs-5">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="mailto:info@campusconnect.com.tr" class="text-dark fs-5">
              <i class="fas fa-envelope"></i>
            </a>
          </li>
        </ul>
        <p class="small mt-3">info@campusconnect.com.tr</p>
      </div>
    </div>

    <div class="text-center border-top pt-3 mt-4 small text-muted">
      © {{ date('Y') }} CampusConnect. Tüm hakları saklıdır.
    </div>
  </div>
</footer>
