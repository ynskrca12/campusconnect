@extends('layouts.master') 

@section('content')

    <div class="row mt-5">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-3 mb-3">
            <div class="mobile-hidden d-block">

                    {{-- <div class="d-flex justify-content-between">
                        <h4 class="sidebarTitle">üniversiteler</h4>

                        <button id="toggle-subcategories" class="btn btn-sm d-none" >
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>

                    </div> --}}
            
                {{-- <div class="mobile-hidden-pagination"> --}}
                    <input type="text" id="university-search" class="form-control mb-2 mt-2 searchInput" placeholder="Üniversite Ara...">
                        <ul id="subcategories-list" class="list-group" > </ul>
            
                        <div id="pagination-container" class="pagination-container mt-3"></div>
                {{-- </div>  --}}
            </div>

            <div class="mobile-show d-none">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> üniversiteni yorumla
                </a>
           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                    {{-- <h5 class="offcanvas-title" id="offcanvasExampleLabel">üniversiteler</h5> --}}
                    <input type="text" id="university-search" class="form-control mb-2 mt-2 searchInput" placeholder="Üniversite Ara...">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">  
                            <ul id="subcategories-list" class="list-group mobile-universities-list"></ul>
                            <div id="pagination-container" class="pagination-container mt-3"></div>
                        </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-9 main-content">          
            <div id="universities-content" class="content-area">

                  <!-- Placeholder Başlangıç -->
              

                <div class="row placeholder-content">

                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">Yükleniyor...</span>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card placeholder-glow">
                            <div class="placeholder-image bg-secondary" style="height: 180px;"></div>
                            <div class="card-body">
                                <h5 class="card-title placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </h5>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-4"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Placeholder Bitiş -->

                <div class="real-content"style="display: none;"> 
                      <h3 class="text-center mb-4">Türkiye’nin En Öğrenci Dostu 10 Üniversitesi (2025)</h3>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="d-flex overflow-auto gap-3 pb-3">
                                @php
                                    $universiteler = [
                                        ['logo' => 'bilkent-universitesi.png','isim' => 'Bilkent Üniversitesi', 'sehir' => 'Ankara', 'yurt' => 8, 'ulasim' => 8, 'sosyal' => 9,'aciklama' => 'Yurt kapasitesi 4.000’ün üzeri blok sayısı ile yüksektir. Modern ve yemyeşil kampüsü bünyesinde yurtlar, spor tesisleri, kütüphane, yemekhane ve diğer tüm olanakları barındırır. Öğrenci kulübü etkinlikleri, konserler ve festivallerle zengin bir sosyal hayat sunar. Ankara şehir merkezine ulaşım da Bilkent-Beytepe metro hattı ve özel servislerle rahat sağlanmaktadır (32 güzergâhta servis mevcut).'],
                                        ['logo' => 'akdeniz-universitesi-seeklogo.png','isim' => 'Akdeniz Üniversitesi', 'sehir' => 'Antalya', 'yurt' => 7, 'ulasim' => 9, 'sosyal' => 9,'aciklama' =>'Konyaaltı’ndaki geniş kampüs şehir merkezine çok yakındır (şehirlerarası otobüs terminaline 1,5 km). Bu sayede toplu taşımayla ulaşım kolaydır. Kampüsünde 2.000 kişilik yemekhane, kafeteryalar, “Yakut Yaşam Alanı” ve “Olbia Kültür Merkezi” gibi sosyal tesisler bulunur. Akdeniz Üniversitesi, yerleşke ve yaşam doyuruculuğu bakımından ikinci sırada yer almıştır.'],
                                        ['logo' => 'anadolu-universitesi-eskisehir.png','isim' => 'Anadolu Üniversitesi', 'sehir' => 'Eskişehir', 'yurt' => 7, 'ulasim' => 9, 'sosyal' => 9,'aciklama' =>'Öğrenci sayısına göre Eskişehir genelinde KYK yurtlarında bol kapasite mevcuttur. Üniversitenin Yunus Emre Kampüsü’nde yurt ve konukevi imkânları bulunur. Eskişehir, “öğrenci şehri” olarak bilinir ve tramvay gibi toplu taşıma ağı sayesinde ulaşım uygundur. Üniversite Memnuniyet Araştırması’nda Anadolu Üniversitesi kampüs hayatı puanında 1. sırada (91 puan) yer almıştır.'],
                                        ['logo' => 'ege-universitesi.png','isim' => 'Ege Üniversitesi', 'sehir' => 'İzmir', 'yurt' => 8, 'ulasim' => 8, 'sosyal' => 8,'aciklama' =>' Bornova’da büyük bir kampüse sahiptir. Kampüs içinde Ege Üniversitesi Öğrenci Köyü adlı yurt bölgesi bulunur; ayrıca KYK’ya bağlı 13 bloklu kız yurdu ile binlerce öğrenci barınabilmektedir (3.804 kişilik tek bir kız yurdu). Kampüs, Bornova merkeze 2 km ve hastaneye 500 m uzaklıkta olduğu için ulaşımı kolaydır. Sosyal olanaklar da geniştir: spor tesisleri, amfi tiyatro ve öğrenciler tarafından düzenlenen kültürel etkinlikler mevcuttur. ÜYE-2024 raporuna göre Ege Üniversitesi yerleşke doyuruculuğunda üst sıralardadır.'],
                                        ['logo' => 'abdullah-gul-universitesi.png', 'isim' => 'Abdullah Gül Üniversitesi', 'sehir' => 'Kayseri', 'yurt' => 7, 'ulasim' => 9, 'sosyal' => 8,'aciklama' =>'Yeni kurulan üniversite kampüsü (Sümer Kampüsü) Kayseri şehir merkezindedir ve çevresi 200 dönümlük yeşil bahçelerle kaplıdır. Kampüs içindeki yurtlar “Öğrenci Köyü” adıyla anılır; 70 yıllık tarihi taş yapılardan oluşan, geniş bahçeli, konforlu apart dairelerdir. Yurdun içinde spor sahaları, çalışma salonları ve sosyal alanlar bulunur. AGÜ öğrencileri, kampüsteki restoranlar, kafeler ve kültürel merkezlerle renkli bir sosyal hayat yaşar. ÜYE-2024’e göre AGÜ genel memnuniyette 3. sıradadır.'],
                                        ['logo' => 'hacettepe-universitesi.png','isim' => 'Hacettepe Üniversitesi', 'sehir' => 'Ankara', 'yurt' => 9, 'ulasim' => 7, 'sosyal' => 8,'aciklama' =>' İki yerleşkesindeki yurt kapasitesi oldukça yüksektir (Beytepe’de 4.159, Sıhhiye’de 1.565 kişilik toplam barınma imkânı). Beytepe kampüsü şehre uzak olmakla birlikte üniversitenin kendi servisleriyle Kızılay’a ulaşım sağlanır. Hacettepe’nin öğrencileri için çok sayıda kulüp ve etkinlik merkezi bulunur; geniş kampüslerde sergiler, spor etkinlikleri, kulüp faaliyetleri gibi zengin bir sosyal ortam mevcuttur.'],
                                        ['logo' => 'izmir-yuksek-teknoloji-enstitusu.png','isim' => 'İzmir Yüksek Teknoloji Enstitüsü', 'sehir' => 'İzmir', 'yurt' => 8, 'ulasim' => 8, 'sosyal' => 7,'aciklama' =>' Türkiye Üniversite Memnuniyet Araştırması 2024’te genel memnuniyet sıralamasında 2. olmuş ve “yerleşke doyumu”nde 3. sıraya girmiştir. Urla’daki kampüsüne İzmir metrosu ve toplu taşıma araçlarıyla erişim mümkün olup, kampüs içi servisler de düzenlidir. İYTE’de çeşitli öğrenci kulüpleri ve uluslararası iş birlikleri bulunur. Bu bilgiler ışığında İYTE’de akademik ve sosyal yaşam dengeli kabul edilmiştir.'],
                                        ['logo' => 'sabanci-universitesi.png','isim' => 'Sabancı Üniversitesi', 'sehir' => 'İstanbul', 'yurt' => 10, 'ulasim' => 6, 'sosyal' => 7,'aciklama' =>' Tuzla’daki kampüste Türkiye’nin nüfusa oranla en yüksek yurt kapasitesi Sabancı’da bulunur. Kampüs içinde tek ve stüdyo odalar, spor tesisleri, yemekhane ve kültürel merkezler mevcuttur. Öğrenciler için Altunizade-Göztepe hattında kampüs servisleri ve İETT ulaşımı sağlanır. Sabancı, öğrenci toplulukları aracılığıyla konserler, söyleşiler ve organizasyonlar düzenleyerek aktif bir sosyal hayat sunar.'],
                                        ['logo' => 'mef-universitesi.png','isim' => 'MEF Üniversitesi', 'sehir' => 'İstanbul', 'yurt' => 6, 'ulasim' => 8, 'sosyal' => 7,'aciklama' =>' Maslak yerleşkesindeki “Republika Yurdu” öğrencilerine 5 yıldızlı otel konforu sunar. Karma barınma için Kağıthane’de lüks konseptli “Academia Yurdu” da vardır; bu yurtlara metro ile ulaşım sağlanır ve kampüs servisi (günde 5 kez) hizmeti verilir. MEF’in merkezi konumu ve modern yurt imkânları, İstanbul’da öğrenciler için konforlu bir ortam yaratır.'],
                                        ['logo' => 'ytu-yildiz-teknik-universitesi-istanbul-seeklogo.png','isim' => 'Yıldız Teknik Üniversitesi', 'sehir' => 'İstanbul', 'yurt' => 2, 'ulasim' => 7, 'sosyal' => 10,'aciklama' =>' YTÜ’nün Davutpaşa ve Yıldız kampüsleri, İstanbul’un göbeğinde olup ulaşım ağlarına (metro ve metrobüs) yakındır. Üniversitede 68 öğrenci kulübü aktif şekilde faaliyet gösterir; bu da YTÜ’nün çok renkli bir sosyal hayata sahip olduğunu gösterir. Öte yandan kamusal yurt kapasitesi sınırlıdır (Davutpaşa Kampüsü’nde toplam 138 yatak).'],
                                    ];
                                @endphp

                                @foreach($universiteler as $uni)
                                    @php
                                        $toplam = $uni['yurt'] + $uni['ulasim'] + $uni['sosyal'];
                                    @endphp

                                    <div class="card shadow-sm flex-shrink-0 custom-card">
                                        <div class="card-body px-4 py-5">
                                            <div class="d-flex justify-content-between">
                                            <img src="{{ asset('university logos/'.$uni['logo']) }}" alt="üniversite Logosu"
                                            class="mb-2" style="height: 50px; object-fit: contain;">
                                           <button class="btn btn-sm btnDetail fs-6 fw-semibold" data-bs-toggle="modal" data-bs-target="#uniModal{{ $loop->index }}">Detay</button>
                                                </div>
                                            <h5 class="card-title">{{ $uni['isim'] }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $uni['sehir'] }}</h6>
                                            <ul class="list-group list-group-flush small mb-3">
                                                <li class="list-group-item ps-0">Yurt: {{ $uni['yurt'] }}/10</li>
                                                <li class="list-group-item ps-0">Ulaşım: {{ $uni['ulasim'] }}/10</li>
                                                <li class="list-group-item ps-0">Sosyal Hayat: {{ $uni['sosyal'] }}/10</li>
                                            </ul>
                                            <div class="text-end fw-bold">
                                                Toplam Puan: <span style="color: #23ade4">{{ $toplam }}/30</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="uniModal{{ $loop->index }}" tabindex="-1" aria-labelledby="uniModalLabel{{ $loop->index }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <img src="{{ asset('university logos/'.$uni['logo']) }}" alt="üniversite Logosu"
                                            class="mb-2 me-3" style="height: 50px; object-fit: contain;">
                                            <h5 class="modal-title" id="uniModalLabel{{ $loop->index }}">{{ $uni['isim'] }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                                        </div>
                                        <div class="modal-body p-5">
                                            {!! nl2br(e($uni['aciklama'])) !!}
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                @endforeach
                            </div>

                            <p class="mt-3 text-muted small">
                                Veriler YÖK, ÜniAr, öğrenci forumları ve sosyal medya platformlarındaki yorumlara dayalı olarak hazırlanmıştır.
                            </p>
                        </div>
                    </div>


                {{-- köklü üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">Köklü Üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/bogazici-universitesi.jpg') }}" alt="bogazici-universitesi">
                                </div>                               
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/odtu.jpg') }}" alt="bogazici-universitesi">
                                </div>                                
                            </div>                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/itu.jpeg') }}" alt="bogazici-universitesi">
                                </div>                                
                            </div>
                            
                        </div>
                    </div>

                    {{-- En çok Tercih Edilen Üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">En çok Tercih Edilen Üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/odtu.jpg') }}" alt="bogazici-universitesi">
                                </div>                                
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/bogazici-universitesi.jpg') }}" alt="bogazici-universitesi">
                                </div>                               
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('well-established universities/hacettepe-uni.jpg') }}" alt="bogazici-universitesi">
                                </div>                               
                            </div>
                            
                        </div>
                    </div>

                    {{-- En çok bilimsel yayın üreten üniversiteler  --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">En çok bilimsel yayın üreten üniversiteler</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/istanbul-uni.jpeg') }}" alt="istanbul-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">1. İstanbul Üniversitesi</h3>
                                        <h4 class="card-location">14.069 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/hacettepe-uni.jpg') }}" alt="hacettepe-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">2. Hacettepe Üniversitesi</h3>
                                        <h4 class="card-location">13.457 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/ankara-uni.jpg') }}" alt="ankara-universitesi">
                                </div>
                                <div class="card-overlay" style="background: rgba(0, 54, 133, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">3. Ankara Üniversitesi</h3>
                                        <h4 class="card-location">11.485 bilimsel yayın</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    {{-- Sanayi ile iş birliği yapan teknoparklara sahip üniversiteler --}}
                    <div class="d-flex justify-content-between mb-3 mt-5">
                        <span class="content-title">Sanayi ile iş birliği yapan teknoparklara sahip üniversiteler</span>
                    </div>
                    {{-- ODTÜ Teknokent: 400+ firma
                    İTÜ ARI Teknokent: 300+ firma
                    Bilkent Cyberpark: 250+ firma
                    Yıldız Teknopark: 350+ firma
                    Hacettepe Teknokent: 200+ firma --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/odtu-teknokent.jpg') }}" alt="odtu-teknokent">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">1. ODTÜ Teknokent</h3>
                                        <h4 class="card-location">400+ firma</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/itu-ari-teknokent.jpg') }}" alt="itu-ari-teknokent">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">2. İTÜ ARI Teknokent</h3>
                                        <h4 class="card-location"> 300+ firma</h4>
                                    </div>
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('universite/bilkent-cyberpark.jpg') }}" alt="bilkent-cyberpark">
                                </div>
                                <div class="card-overlay"  style="background: rgba(109, 175, 108, 0.8);">
                                    <div class="card-content">
                                        <h3 class="card-title">3. Bilkent Cyberpark</h3>
                                        <h4 class="card-location"> 250+ firma</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
@endsection 

@section('css')
    <style> 

        .content-wrapper {
            padding:2.75rem 15px !important;
        } 
        .custom-card{
            width: 300px !important;
            border-radius: 17px !important;
        }
        .btnDetail{
            background-color: transparent;
            color: #001b48 !important;
            border: none !important;
        }

    </style>
    <style>
        .general-topic-btn{
            font-family: 'Segoe UI', Tahoma, Geneva, sans-serif !important;  
            font-size: 15px !important; 
            font-weight: 500 !important; 
            color: #333 !important; 
            background-color: transparent !important;
            padding: 8px 12px !important; 
            text-align: center !important;
            text-transform: none !important; 
            letter-spacing: 0.3px !important; 
            cursor: pointer;
        }
         .topic {
            padding: 10px 0;
        }
       
        .topic h3 {
            margin: 0;
            font-size: 17px;
            color: #333;
        }
        .topic p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .topic .meta {
            display: flex;
            justify-content: end;
        }
        #subcategories-list .list-group-item{
            border:none !important;
            padding: 7px 0px;
        }
        #subcategories-list .list-group-item:hover{
            border-bottom:1px solid !important;
        }
        .btnCreateGeneral:hover , .btnCreateCity:hover , .btnCreateUniversity:hover{
            border-bottom: 1px groove #000000 !important;
            border-radius: 0px !important;
        }
        .content-title{
            font-size: 20px;
            font-weight: 600;
        }
        .content-area {
            padding: 0px 10px;
            
        }
        .activeCategory {
            border-bottom: 1px solid gray;
            color: #333 !important;
            border-radius: 0px;
        }
        .activeCategory:hover{
            border-bottom: 1px solid gray;
        }
        .universityTag, .cityTag, .subCategoryTag{
            color: #000000 !important;
            font-size: 13px;
            font-weight: 400;
        }
       
        .universityLi:hover , .cityLi:hover{
            background-color: #fafafae0; 
        }

        .swal2-title{
                font-size: 18px !important;
        }

       .swal-custom-popup {
            width: 420px !important; 
        }
        .topic-title{
            font-weight: bold;
            word-wrap: break-word;
            padding-right: 130px;
        }

        .topic-title-sub-category {
            flex: 1;
            word-wrap: break-word; 
            word-break: break-word;
        }

        .count {
            margin-left: auto; 
            display: inline-block;
            margin-left: 15px;
            font-weight: 700;
            color: #001b48;
        }

    </style>

    <style>
         /* card css */
         .card-container {
            position: relative;
            width: auto; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .card-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .card-overlay {
            position: absolute;
            top: 0;
            right: 0;
            left: 0%;
            background: rgb(255 0 0 / 80%); 
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            height: 60px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            transition: transform 0.3s ease, box-shadow 0.3s ease; 
        }

        .card-overlay:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .card-content {
            text-align: center;
        }

        .badge img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 16px;
            margin: 10px 0px;
        }

        .card-location {
            font-size: 13px;
        }
    </style>

    <style>
        .searchInput{
            border: none;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 0;
            padding: 0;
        }

        .searchInput:focus{
            box-shadow: none;
        }
      #pagination-container a {
          text-decoration: none; 
          padding: 5px 7px; 
          margin: 0 5px; 
          color: #001b48 !important; 
          border:none;
      }
      #pagination-container .active {
        background: #001b48 !important;
        border-color: #001b48 !important;
      }

    </style>

    <style>
        .page-title {
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 10px 0;
            color: white;
            background: #001B48; 
            padding: 10px; 
            border-radius: 5px; 
        }

        .main-content{
            border-left: 1px solid #e0e0e0;
        }

        .real-content {
            display: none;
        }

    </style>

    {{-- mobil --}}
    <style>
        @media (max-width: 768px) {
            .main-content{
                border-top: 1px solid #e0e0e0;
                border-left: none;
            }

            .page-title{
                font-size: 14px;
                font-weight: 400;
            }

            .content-title{
                font-size: 16px;
            }

            .sidebarTitle{
                font-size: 20px;
            }

            .card-container{
                margin-bottom: 15px;
            }

            #toggle-subcategories{
                display:block !important;
            }

            .mobile-hidden-pagination {
                display: none;
            }

            #toggle-subcategories i {
                transition: transform 0.3s ease;
            }

            #toggle-subcategories.collapsed i {
                transform: rotate(180deg);
            }

            .mobile-show{
                display: block !important;
            }

            
            .mobile-hidden{
                display: none !important;
            }
            .custom-offcanvas {
                width: 310px; 
            }

            .content-area {
                padding: 15px 0px;
            }

            .custom-card{
                width: 100%;
            }
        }

    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <script>
        $(document).ready(function () {
            function loadUniversities(page = 1, query = '') {
                $.ajax({
                    url: '/universities/fetch',
                    type: 'GET',
                    data: { page: page, search: query },
                    success: function (response) {
                        let universitiesHtml = '';
                        $.each(response.universities.data, function (index, item) {
                            const topicCount = response.universities_topics_count[item.id] || 0;
                            universitiesHtml += `
                                <li class="list-group-item universityLi">
                                    <a href="/universite-yorumlari/${item.slug}" class="text-decoration-none universityTag d-flex justify-content-between">
                                        <span class="topic-title-sub-category">${item.universite_ad}</span>
                                        <span class="count">${topicCount}</span>
                                    </a>
                                </li>`;
                        });
                        $('#subcategories-list').html(universitiesHtml);
                        $('.mobile-universities-list').html(universitiesHtml);
                        
                        // Sayfa bağlantılarını güncelle
                        $('#pagination-container').html(response.links);
                        $('.pagination-container').html(response.links);
                    },
                    error: function () {
                        alert('Üniversiteler yüklenirken bir hata oluştu.');
                    }
                });
            }
    
            // İlk yükleme
            loadUniversities();
    
            $(document).on('click', '#pagination-container a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = new URL(url).searchParams.get('page');
                const query = $('.searchInput').val();
                loadUniversities(page, query);
            });
    
            $(document).on('input', '.searchInput', function () {
                const query = $(this).val();
                console.log(query)
                loadUniversities(1, query);
            });
        });
    </script>
    
    <script>
        $(document).ready(function () {
                $('#toggle-subcategories').on('click', function () {
                    // Toggle the visibility of the list
                    $('.mobile-hidden-pagination').slideToggle();

                    // Rotate the arrow icon
                    $(this).toggleClass('collapsed');
                });
            });

    </script>
    
    <script>
       document.addEventListener("DOMContentLoaded", function () {
            const placeholderContent = document.querySelector(".placeholder-content");
            const realContent = document.querySelector(".real-content");

            // Placeholder'ları göster
            placeholderContent.style.display = "flex";
            realContent.style.display = "none";

            // 3 saniye sonra gerçek içeriği göster
            setTimeout(function () {
                placeholderContent.style.display = "none"; // Placeholder'ları gizle
                realContent.style.display = "block"; // Gerçek içeriği göster
            }, 3000);
        });


    </script>
@endsection
