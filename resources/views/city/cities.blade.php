@extends('layouts.master') 

@section('content')

    <div class="row mt-5">
        <!-- Sol Menü (Alt Başlıklar) -->
        <div class="col-md-2 mb-3">
            <div class="mobile-hidden d-block">
                <input type="text" id="city-search" class="form-control mb-2 mt-2 searchInput" placeholder="Şehir Ara...">
                <ul id="subcategories-list" class="list-group" ></ul>
                <div id="pagination-container" class="pagination-container mt-3"></div>
            </div>

            <div class="mobile-show d-none">
                <a class="btn btn-primary w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class="bi bi-chat-dots me-2"></i> şehirleri yorumla
                </a>
           

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <input type="text" id="city-search" class="form-control mb-2 mt-2 searchInput" placeholder="Şehir Ara...">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                        <div class="offcanvas-body">
                            <ul id="subcategories-list" class="list-group mobile-cities-list" > </ul>
                            <div id="pagination-container" class="pagination-container mt-3">
                        </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Ana İçerik Alanı -->
        <div class="col-md-10 main-content px-4">          
            <div id="cities-content" class="content-area">

                <div class="real-content">
                   
                    
                    <div class="container mb-5 p-0">
                        <h3 class="text-center mb-4 fw-bold city-content-title">Türkiye’nin En İyi 10 Öğrenci Şehri</h3>
                        <p class="text-center text-muted mb-4 fst-italic">
                            Kira, KYK yurt kapasitesi ve öğrenci yaşam kalitesi verilerine göre hazırlandı.
                        </p>

                        <div class="row g-4">
                            @php
                                $cities = [
                                    ['name' => 'Eskişehir', 'rent' => '15.098 TL', 'kyk' => '10.000', 'source' => 'tele1.com.tr', 'rating' => 5, 'tags' => ['Uygun Kira', 'Canlı Sosyal Hayat'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ' Türkiye’nin “öğrenci şehri” olarak ün salmış olan Eskişehir, 3 büyük devlet üniversitesi (Anadolu Ünv., Osmangazi Ünv., Teknik Ünv.) sayesinde canlı bir öğrenci toplumuna sahiptir. Barlar Sokağı, Porsuk çayı kıyısı kafe-barları ve öğrenci dostu sosyal etkinlikler ön plandadır. Uygun yaşam maliyetleri ve düşük suç oranıyla güvenli bir ortama sahiptir'
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => '  Temmuz 2024 itibarıyla ortalama kira ~15.100 TL (1+0) civarında . Şehir merkezinde uygun fiyatlı ev seçenekleri mevcuttur.'
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'KYK ve özel yurtlarda toplamda yaklaşık 10.000 öğrenci kapasitesi
                                            bulunmaktadır (Anadolu ve Osmangazi Üniversiteleri için). Çoğu yurt şehir merkezine yakın,
                                            toplu taşımaya entegredir. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Kent içi ulaşımda geniş bir tramvay ve otobüs ağı vardır. EskişehirKart ile
                                            öğrenciler indirimli bilet kullanabilir. Şehir kompakt yapıda olduğundan kampüslere ulaşım
                                            görece rahattır.'
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Eskişehir’de gün boyu öğrenci konserleri, tiyatro gösterimleri ve festivaller
                                            düzenlenir. Porsuk’ta yaz aylarında açık hava konserleri, kışın üniversite etkinlikleri yapılır.
                                            Odunpazarı evleri bölgesinde sanat etkinlikleri ve yıllık Eskişehir Film Festivali gibi
                                            organizasyonlar bulunur. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Anadolu ve Osmangazi Üniversitelerinde her fakülteye göre organize
                                            edilmiş onlarca öğrenci kulübü (bilim, kültür, spor vb.) vardır. Şehirde düzenli öğrenci buluşmaları
                                            ve kulüp etkinlikleri yaygındır. '
                                        ],
                                        ]
                                    ],
                                    ['name' => 'İzmir', 'rent' => '21.903 TL', 'kyk' => '14.717', 'source' => 'tele1.com.tr', 'rating' => 4, 'tags' => ['Sahil Şehri', 'Kültürel Etkinlik'],
                                         'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'Ege Bölgesi’nin büyük metropolü İzmir, 6’sı devlet (Ege, Dokuz Eylül, Celal
                                                Bayar vb.) ve 3’ü vakıf olmak üzere 9 üniversiteye ev sahipliği yapar. Ilıman iklim, sahil kıyıları
                                                (Kordon, Alaçatı), geniş sosyal yaşam imkânları ile ön plana çıkar. Şehirde özellikle Karşıyaka ve
                                                Alsancak gibi bölgeler genç nüfusa uygundur. Kordonboyu’nda açık hava etkinlikleri ve üniversite
                                                kulüplerinin konserleri sıkça görülür. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira yaklaşık 21.903 TL (Temmuz 2024) civarındadır. Diğer büyük
                                            şehirlere göre biraz daha yüksektir; ancak şehir çevresi uygun semtlerde daha makul fiyatlı ev
                                            bulmak mümkündür. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'KYK yurtlarında toplam 14.717 yatak bulunur. Bunun büyük kısmı kadın
                                            yurdu kapasitesidir. Bu da kentteki ~154.000 öğrencinin önemli bir kısmına yurt imkânı sağlar.
                                            Özel öğrenci evleri de yaygındır. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => 'Toplu taşımada metro (İZBAN ve İzmir Metrosu), geniş ESHOT otobüs ağı ve
                                            vapur hizmetleri mevcuttur. İzmirim Kart’la öğrenci indirimleri (%50) uygulanır. Kampüsler
                                            (Bornova, Bayraklı vb.) metro hatlarına yakın konumdadır'
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'İzmir, yıl boyunca çok sayıda konser, tiyatro ve film festivallerine ev sahipliği
                                            yapar. Uluslararası İzmir Fuarı, İzmir Müzik Festivali, film festivalleri (Tunca, Kısa Film) gibi
                                            etkinlikler düzenlenir. Tarihi konaklar, müzeler ve kordon boyu kültür-sanat doludur. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Ege Üniversitesi bünyesinde 84 aktif öğrenci topluluğu bulunmaktadır
                                            . Dokuz Eylül ve diğer üniversitelerde de her bölümde spor, kültür, bilim kulüpleri vardır. İzmir
                                            genelinde yüzlerce öğrenci kulübü faaliyettedir. '
                                        ],
                                        ]],
                                    ['name' => 'Ankara', 'rent' => '20.965 TL', 'kyk' => '21.500', 'source' => 'tele1.com.tr', 'rating' => 4, 'tags' => ['Başkent', 'Ulaşım Kolay'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ' Başkent Ankara, ODTÜ, Hacettepe, Ankara, Gazi, Bilkent, Başkent gibi
                                            köklü üniversiteleriyle yoğun öğrenci nüfusuna sahiptir. Şehir planlı yapısıyla konut çeşitliliği
                                            sunar; kampüs çevrelerinde uygun fiyatlı yurt ve ev imkânı vardır. Ankara’daki sosyal yaşamda
                                            kampüs kafeleri, gençlik parkları ve vakıf ünitelerindeki etkinlikler dikkat çeker. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~20.965 TL civarındadır. Büyük şehirlere göre makul
                                            sayılabilir; şehir dışı semtler (Keçiören, Sincan vb.) daha ucuz konutlar sunar. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'Başkentte KYK yurtlarında toplam yaklaşık 21.500 yatak kapasitesi bulunur (her
                                            iki cinsiyetten). Ankara merkez ve ilçelerde çok sayıda yurt mevcuttur. Ayrıca kampüs yurtları
                                            (ODTÜ, Hacettepe vb.) yerleşkelerde yer alır. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Metro, dolmuş ve geniş belediye otobüsleriyle ulaşım rahattır. Ankarakart
                                            öğrenci indirimleri (%40-50) sunar. İl dışından gelen birçok öğrenci için başkente giriş Çubuk ve
                                            Kırıkkale otobanları ile kolaydır'
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => ' Ankara Devlet Opera ve Balesi, Devlet Tiyatroları gibi sahnelerin yanı sıra
                                            birçok üniversite bahçe konserleri ve festivaller düzenler. Uluslararası film festivali (Filmmor), caz
                                            festivali gibi etkinlikler vardır. Birçok müze ve sergi salonu öğrencilerin ücretsiz girişine uygundur.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => ' Ankara’daki üniversitelerde yüzlerce öğrenci kulübü bulunur. Örneğin
                                            ODTÜ ve Hacettepe’de her fakültede öğrenci kulüpleri (teknoloji, spor, kültür, girişimcilik vb.)
                                            faaldir. Kampüs içi yurtlar da kendi sosyal faaliyetlerini organize eder.'
                                        ],
                                        ]],
                                    ['name' => 'İstanbul', 'rent' => '23.373 TL', 'kyk' => '58.466', 'source' => 'haber.sol.org.tr', 'rating' => 3, 'tags' => ['Mega Kent', 'Yüksek Rekabet'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ' İstanbul, Boğaziçi, İTÜ, İstanbul Üniversitesi, Bilgi, Sabancı, Koç gibi çok
                                                sayıda üniversite ile Türkiye’nin en büyük öğrenci şehridir. Tarihi ve kültürel zenginlikleri, eğlence
                                                mekânları ve uluslararası ortamı öğrenciler için eşsiz imkânlar sunar. Kentin büyük nüfusuna
                                                rağmen kampüs bölgesi semtleri (Avrupa Yakasında Beşiktaş, Anadolu’da Kadıköy/Bostancı)
                                                öğrencilerce tercih edilir. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => 'Ortalama kira ~23.373 TL ile ülkenin en yükseğidir. Özellikle Avrupa Yakası
                                            merkezinde kiralar çok yüksektir; ancak İstanbul’un farklı semtlerinde (Üsküdar, Beylikdüzü vb.)
                                            daha uygun alternatifler bulunabilir.'
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => ' İstanbullu KYK yurtlarının toplam kapasitesi 58.466 yataktır (erkek 23.782, kadın 34.684). Bu sayı, İstanbul’daki 1.034.553 öğrencinin ancak %30’unu karşılayabilmektedir
                                            . Şehir merkezinde 14 devlet ve 44 vakıf üniversitesi olmak üzere toplam 61 üniversite
                                            bulunur.'
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => 'İstanbul’da metro, metrobüs, vapur, füniküler gibi çok katmanlı toplu taşıma
                                            ağı gelişmiştir. Öğrenciler İstanbulkart ile %50 indirimli seyahat eder. Ayrıca şehir içi minibüs,
                                            dolmuş ve otobüs seçenekleri çoktur. Gece ulaşımı da nispeten güçlüdür. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'İstanbul’da her gün çok sayıda konser, sergi, tiyatro ve festival düzenlenir.
                                            İstanbul Film Festivali, Caz Festivali, Bienal gibi uluslararası etkinlikler, popüler müzeler (Pera,
                                            İstanbul Modern vb.) öğrenciler için cazibe yaratır. Tarihi yarımada ve Boğaz kenarında da
                                            ücretsiz kültürel faaliyetler mevcuttur.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'İstanbul’daki üniversitelerde binlerce öğrenci kulübü vardır. Örneğin
                                            Boğaziçi Üniversitesi bünyesinde onlarca topluluk, İTÜ ve Okan gibi büyük vakıf üniversiteleri de
                                            sayısız spor, kültür, kariyer kulübü barındırır. Kent genelinde öğrenci festivalleri ve kampüs
                                            şenlikleri yaygındır. '
                                        ],
                                        ]],
                                    ['name' => 'Antalya', 'rent' => '18.749 TL', 'kyk' => '13.577', 'source' => 'tele1.com.tr', 'rating' => 4, 'tags' => ['Deniz & Güneş', 'Turistik'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'Akdeniz Üniversitesi (Muratpaşa) ve Alanya Alaaddin Keykubat
                                            Üniversitesi ile Antalya’da çok sayıda öğrenci yaşar. Ilıman iklimi ve sahil şeridi sayesinde kış
                                            mevsiminde bile açık hava etkinlikleri yapılır. Liman ve Kaleiçi bölgesi, öğrencilere cazip sosyal
                                            hayat imkânları sunar. Turistik altyapı, zengin yeme-içme seçenekleri sağlar.'
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~18.749 TL’dir . Turist yoğunluğu nedeniyle nispeten yüksek
                                            olmakla birlikte, toplu konut bölgelerinde daha uygun daireler bulunabilir. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'Antalya’da KYK yurtlarının toplam kapasitesi yaklaşık 13.577 yataktır (Merkez, Alanya, Gazipaşa, Manavgat vb. dahil). İki büyük ilçedeki (Muratpaşa, Alanya) yurt sayısı
                                                    fazladır. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Şehir içinde otobüs ve yeni açılan tramvay hattı (Park-Expo, Havalimanı) hizmet
                                                verir. AntalyaKart ile öğrencilere indirim uygulanır. Havalimanı ve liman kent merkezine yakındır. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => ' Antalya, ünlü Aspendos Opera ve Bale Festivali ile bilinir. Uluslararası Antalya
                                            Altın Portakal Film Festivali, caz festivalleri, yazlık açık hava konserleri öğrenciler arasında popülerdir. Yaz dönemi enstrüman festivalleri ve kumarhane-casino eğlenceleri de dikkat çeker.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Akdeniz Üniversitesi’nin birçok fakültesinde (Turizm, Eğitim, Spor, Sağlık
                                                vb.) aktif öğrenci kulüpleri vardır. Gençlik Toplulukları ile kültür-sanat etkinlikleri organize edilir.
                                                Alanya’da da bölge kulüpleri ve yurt içi geziler düzenlenir. '
                                        ],
                                        ]],
                                    ['name' => 'Bursa', 'rent' => '16.044 TL', 'kyk' => '7.100', 'source' => 'tele1.com.tr', 'rating' => 3, 'tags' => ['Sanayi Şehri', 'Tarihi Doku'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ' Bursa, Uludağ Üniversitesi ve Bursa Teknik Üniversitesi gibi büyük
                                            kampüslere sahiptir. Hem sanayi hem turizm şehri olarak kendine özgü bir yapısı vardır. Orman
                                            ve göl kenarı gibi doğal dinlenme alanları öğrencilere rahatlatıcı ortam sunar. Kültürel miras
                                            (Yeşil Türbe, Tarihi Çarşılar) sosyal hayata zenginlik katar. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~16.044 TL’dir . Marmara bölgesinin ikinci büyük şehri olması
                                                sebebiyle konut arzı fazladır, merkez dışı semtlerde uygun kiralar vardır. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => ' KYK yurtlarında toplam ~7.100 yatak bulunur (Bursa merkez ve ilçelerde).
                                                Bu da Bursa’daki ~360.000 öğrencinin bir kısmını karşılar. Şehir içindeki yurtlar genellikle
                                                üniversite kampüslerine göredir. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => 'Bursa’da metro ve tramvay (Yenişehir hattı) vardır. Bursakart öğrenci indirimleri
                                            ile toplu taşımaya erişim %50’ye varan indirimlerle mümkündür. Yenişehir otogarı ve metrobüs
                                            bağlantısı mevcuttur. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => ': Bursa Uludağ Festivali, Nilüfer Müzik Festivali, turizm sezonunda açık hava
                                            konserleri öne çıkar. Tarihi çarşılar, panayırlar ve kültür etkinlikleri (Atatürk Kongre Kültür Merkezi
                                            programları) yıl boyu sürer. Karagöz-Hacivat gölge oyunu ve göle nazır etkinlikler de turist
                                            öğrenci ortaklığı içindedir. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Uludağ Üniversitesi bünyesinde 50’den fazla öğrenci topluluğu
                                                listelenmiştir (ör. Astronomi, Girişimcilik, Mühendislik toplulukları). Ayrıca Teknik ve Sağlık
                                                Üniversiteleri’nde de spor, kültür, bilim kulüpleri mevcuttur. '
                                        ],
                                        ]],
                                    ['name' => 'Konya', 'rent' => '17.309 TL', 'kyk' => '19.012', 'source' => 'tele1.com.tr', 'rating' => 4, 'tags' => ['Huzurlu', 'Büyük Kampüsler'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ': Anadolu Üniversitesi’nin (Eskişehir) büyük açıköğretim merkezinin yanı
                                            sıra Konya’da Selçuk ve Necmettin Erbakan Üniversiteleri bulunur. Mevlana şehrinin saygınlığının
                                            yanı sıra geniş üniversite kampüsleri (Selçuk Üniversitesi Meram Kampüsü vb.) kent dokusuna
                                            öğrenci ruhu katar. Yaz-kış sakin bir eğitim ortamı sunar. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~17.309 TL’dir. İç Anadolu’nun diğer büyük illerine göre
                                            dengeli kiralar mevcuttur. Şehir merkezine uzak semtlerde fiyatlar daha düşüktür'
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => ': KYK yurt kapasitesi merkezdeki yurtlarla toplam ~19.012 yataktır. Konya
                                            genelinde çok sayıda (Kadın/Erkek ayrı) yurt mevcuttur. Anadolu Üniversitesi’nin uzaktan eğitimi
                                            öğrenci sayısını artırsa da yurt arzı genelde yeterlidir. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Kent içi ulaşımda tramvay (Karatay-Ereğli hattı), geniş otobüs ağı ve taksiler
                                            bulunur. KONYAKART öğrenci tarifesi %50 indirimlidir. Konya’nın tam merkezinde olmayan
                                            üniversiteler tramvayla bağlanır. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Her Aralık’ta Şeb-i Arus (Mevlana’yı Anma Törenleri) büyük bir kültürel
                                            etkinliktir. Ayrıca geleneksel sema gösterileri, ilahiler ve konserler düzenlenir. Selçuklu
                                            döneminden kalma eserlerde zaman zaman sergi ve etkinlikler yapılır. Konya Kitap Fuarı da
                                            öğrenci ilgisini çeker. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => ' Selçuk Üniversitesi ve Konya Teknik’te tıp, eğitim, spor, araştırma odaklı
                                            çok sayıda öğrenci topluluğu vardır. Özellikle tasavvuf ve sosyal sorumluluk kulüpleri yaygındır. '
                                        ],
                                        ]],
                                    ['name' => 'Kocaeli', 'rent' => '18.248 TL', 'kyk' => '15.532', 'source' => 'tele1.com.tr', 'rating' => 3, 'tags' => ['İstanbul’a Yakın', 'Endüstri'],
                                'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'İstanbul’a yakınlığı nedeniyle tercih edilen Kocaeli, özellikle Gebze Teknik
                                            Üniversitesi ve Kocaeli Üniversitesi ile öne çıkar. Marmara Denizi kıyısında yer alan şehirde
                                            üniversite kampüsleri kolay erişilirdir. Genç nüfusa uygun sosyal mekânlar (örneğin öğrenciler
                                            için özel kafeler) gelişmektedir. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~18.248 TL’dir. İstanbul’a kıyasla makul, özellikle üniversite
                                            kampüsüne yakın Yuvam, Karamürsel gibi ilçelerde uygun seçenekler vardır. Kocaeli’nin merkez ve ilçelerinde (Gebze, Gölcük, İzmit) birçok devlet yurdu mevcuttur. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => ': KYK yurtlarında toplam ~15.532 yatak kapasitesi bulunur. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Marmaray hattıyla İstanbul’a bağlanır (Yenikapı–Gebze); şehiriçi servis ve
                                            belediye otobüsleri yoğun kullanılır. KocaeliKart öğrenci indirimine izin verir. İstanbul’a kolay
                                            ulaşım, öğrenciler için büyük avantajdır. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Kocaeli’de Kocaeli Fuarı, üniversite bahar şenlikleri, bilimsel etkinlikler yapılır.
                                            “Uluslararası Kocaeli Kısa Film Festivali” gibi etkinlikler düzenlenir. İzmit’in kültür merkezleri ve
                                            sahil bandında zaman zaman konserler gerçekleşir. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Gebze Teknopark yakınında yer alan üniversitelerde teknoloji ve
                                            girişimcilik kulüpleri popülerdir. Kocaeli Üniversitesi’de mühendislik kulüpleri, spor takımları ve
                                            öğrenci toplulukları (robotik, kodlama, sosyal sorumluluk vb.) faaldir. '
                                        ],
                                        ]],
                                    ['name' => 'Adana', 'rent' => '17.293 TL', 'kyk' => '10.600', 'source' => 'endeksa.com', 'rating' => 3, 'tags' => ['Sıcak İklim', 'Yemek Kültürü'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => ': Çukurova Bölgesi’nin merkezi olan Adana’da Çukurova Üniversitesi ve A.
                                            Özyeğin Üniversitesi (AOSB) yer alır. Sıcak iklimi nedeniyle kışın bile açık hava etkinlikleri
                                            düzenlenir. Lezzetli yemek kültürü (Adana kebabı, şalgam) sosyal hayata renk katar. Tarihi Taş
                                            Köprü ve Ulu Camii çevresi gençlerin takıldığı noktalardır. '
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => ' Ortalama kira ~17.293 TL civarındadır. Emlak piyasası göreceli olarak
                                            İstanbul/Ankara’ya göre ucuz sayılabilir; merkezdeki yeni binalar dışında daha uygun fiyatlı evler
                                            bulmak mümkündür. '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'KYK yurtlarında toplam ~10.658 yatak kapasiteli konaklama vardır (Adana
                                            Merkez ve çevre ilçelerde). Bu yurtlar genellikle şehrin farklı bölgelerine dağılmıştır. Özel
                                            yurtlar da önemli sayıda öğrenciyi barındırır. '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Şehir içi ulaşımda Metro (1 hattı) ve otobüs hatları bulunmaktadır. ADANAKART
                                            öğrencilere indirimli bilet imkânı sunar. Ulaşım ağının genişletilmesi (çevre yoluyla üniversite
                                            entegrasyonu vb.) planlanmaktadır. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Türkiye’nin en eski film festivallerinden biri olan Altın Koza Film Festivali
                                            Adana’da düzenlenir. Müzik ve tiyatro etkinlikleri sıkça yapılır. Ramazanda Büyük Saat çevresi
                                            etkinlikleri, Adana Tarım Fuarı gibi kültürel organizasyonlar öğrencilerin katılımına açıktır. '
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Çukurova Üniversitesi’nin her fakültesinde çeşitli öğrenci kulüpleri
                                            (satranç, gitar, tiyatro, yazılım, sosyal sorumluluk vb.) faaliyet gösterir. Üniversite sportif şenlikleri
                                            ve topluluk buluşmaları sosyal hayata katkıda bulunur. '
                                        ],
                                        ]],
                                    ['name' => 'Mersin', 'rent' => '24.000 TL', 'kyk' => '–', 'source' => 'medyatava.com', 'rating' => 2, 'tags' => ['Deniz Kenarı', 'Sıcak Hava'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'Akdeniz kıyısında yer alan Mersin, Mersin Üniversitesi ve Tarsus Teknik
                                            Üniversitesi ile öğrenci potansiyeline sahiptir. Uzun sahil şeridi (Kızkalesi, Mezitli sahili vb.) ve
                                            ılıman iklim, rahat bir yaşam sunar. Turistik liman kenti olması nedeniyle sosyal tesisler (marina,
                                            kafe-sanat merkezleri) gelişiktir. Medyatava haberine göre Mersin, “uygun konut fiyatları” ve
                                            gelişen altyapısıyla cazip bir şehir olarak öne çıkmıştır.'
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => 'Yaklaşık 24.000 TL civarında (genel ortalama). Ülke genelinde nispeten yüksek
                                                kiralara sahip olsa da, kent merkezindeki bazı semtlerde daha uygun daireler bulunabilir. (Kesin
                                                rakam ülke veri portallarından güncellenebilir.) '
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'Mersin’de KYK yurtlarında Mersin merkez ve Tarsus’ta birkaç bin kişilik kapasite
                                            mevcuttur. Örneğin Mezitli ve Yenişehir’de devlet yurtları bulunur. Toplam kapasite ~6.000–8.000
                                            aralığındadır (resmî güncel rakamlar zamanla değişebilir). '
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => ' Şehir içi otobüs ve minibüs hatları yaygındır. Uzun mesafeli otogarlara ve
                                            limana yakın konumuyla erişim kolaydır. Yeni kurulan hatlar (örneğin boğaz üzerinden teleferik
                                            projeleri) öğrenci ulaşımını geliştirecektir. '
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Mersin Uluslararası Müzik Festivali, Narenciye Festivali ve Liman Kent Festivali
                                            gibi etkinlikler düzenlenir. Açık hava konserleri, tiyatrolar ve öğrenci odaklı atölye çalışmaları
                                            popülerdir. Tarihi Kızkalesi çevresindeki turistik etkinlikler de öğrencilere değişik deneyim sunar.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => ' Mersin Üniversitesi kampüsünde çok sayıda öğrenci kulübü vardır
                                            (muzik, halk oyunları, bilim, girişimcilik vb.). Tarsus’taki meslek yüksekokullarında da gençlik
                                            kulüpleri bulunur. Kent merkezindeki sivil toplum kuruluşları ve gençlik merkezleri öğrenci
                                            etkinliklerine imkân sağlar. '
                                        ],
                                        ]],
                                    ['name' => 'Trabzon','rent' => '16.882 TL','kyk' => 'Bilgi bulunamadı','source' => 'Günebakış Gazetesi', 'rating' => 4, 'tags' => ['Doğa ile İç İçe', 'Sahil Şehri'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'Karadeniz Teknik Üniversitesi (KTÜ) sayesinde Trabzon uzun yıllardır öğrenci nüfusuna ev sahipliği yapmaktadır. Deniz kenarında yer alan kampüsler, doğa ile iç içe bir üniversite deneyimi sunar. Halkın öğrencilere yaklaşımı genellikle sıcaktır ve şehirde öğrencilere özel kampanyalar, indirimler ve sosyal alanlar mevcuttur.'
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => '2024 itibarıyla Trabzon’da 1+1 dairelerin ortalama kira fiyatı yaklaşık 11.000 TL civarındadır. Üniversiteye yakın mahallelerde daha uygun fiyatlı kiralık daireler bulunabilir.'
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'KTÜ bünyesindeki KYK yurtlarının yanı sıra birçok özel yurt da şehirde hizmet vermektedir. Toplamda yaklaşık 8.000 öğrenci kapasitesi bulunur. Yurtlar genellikle üniversite kampüslerine ve toplu taşımaya yakındır.'
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => 'Şehir içi ulaşım minibüs, otobüs ve dolmuşlarla sağlanmaktadır. Öğrenciler için indirimli ulaşım kartları sunulmaktadır. Üniversite kampüsleri şehir merkezine görece yakındır. Havalimanı kampüse yakın konumda bulunur.'
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Trabzon Devlet Tiyatrosu, çeşitli konser salonları ve KTÜ\'nün düzenlediği etkinlikler yıl boyunca öğrencilere kültürel alternatifler sunar. Ayrıca Trabzon Sanatevi gibi merkezlerde sergiler ve şiir geceleri düzenlenmektedir.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'KTÜ bünyesinde 100’den fazla öğrenci kulübü (müzik, tiyatro, robotik, girişimcilik vb.) aktif olarak çalışmaktadır. Kampüs içi etkinlikler yıl boyunca devam eder ve topluluklar arasında iş birliği yaygındır.'
                                        ],
                                        ]],
                                    ['name' => 'Kayseri','rent' => '13.955 TL','kyk' => '10.000+','source' => 'Endeksa, Kayserim.net','rating' => 4,'tags' => ['Uygun Kira', 'Gelişen Şehir'],
                                        'descriptions' => [ [
                                            'icon' => 'fa-user-graduate',
                                            'title' => 'Öğrenci Dostu Yönleri',
                                            'content' => 'Erciyes Üniversitesi ve Kayseri Üniversitesi sayesinde şehirde ciddi bir öğrenci nüfusu bulunmaktadır. Şehir, düzenli yapısı, güvenliği ve uygun yaşam maliyetleri ile öne çıkar. Sanayi şehri olmasının avantajıyla iş/staj imkanları geniştir. Halk genellikle yardımsever ve öğrenciye karşı misafirperverdir.'
                                        ],
                                        [
                                            'icon' => 'fa-home',
                                            'title' => 'Kira ortalaması',
                                            'content' => '2024 Temmuz itibarıyla Kayseri’de ortalama kira fiyatı 1+1 daireler için yaklaşık 9.500 TL civarındadır. Kampüse yakın bölgelerde daha uygun fiyatlı daireler bulunabilir. KYK yurtları dışında öğrenci evleri de oldukça yaygındır.'
                                        ],
                                        [
                                            'icon' => 'fa-bed',
                                            'title' => 'Yurt kapasitesi',
                                            'content' => 'KYK ve özel yurtlarla birlikte toplamda 12.000’in üzerinde öğrenci kapasitesi sunulmaktadır. Yurtlar genellikle kampüse yürüme mesafesindedir. Fiyatlar ve hizmet çeşitliliği oldukça geniştir.'
                                        ],
                                        [
                                            'icon' => 'fa-plane-departure',
                                            'title' => 'Ulaşım kolaylığı',
                                            'content' => 'Kayseri’de modern tramvay ve otobüs ağı öğrencilerin şehir içinde rahat hareket etmesini sağlar. Kart38 isimli toplu taşıma kartı ile öğrenciler indirimli seyahat edebilir. Ulaşım sık ve düzenlidir, kampüs hatları oldukça yoğundur.'
                                        ],
                                        [
                                            'icon' => 'fa-utensils',
                                            'title' => 'Kültürel etkinlik',
                                            'content' => 'Şehirde düzenli olarak tiyatro, konser ve film festivalleri yapılmaktadır. Erciyes Kültür Merkezi, Kayseri Devlet Tiyatrosu gibi merkezler öğrenciler tarafından sıkça tercih edilir. Üniversiteler dönemsel olarak bilim ve sanat etkinlikleri düzenlemektedir.'
                                        ],
                                        [
                                            'icon' => 'fas fa-theater-masks',
                                            'title' => 'Kulüp/topluluk sayısı',
                                            'content' => 'Erciyes Üniversitesi’nde aktif olarak çalışan 150\'den fazla öğrenci topluluğu bulunmaktadır. Spor, bilim, gönüllülük, teknoloji ve kültür alanında faaliyet gösteren kulüplerle öğrenciler sosyal yönlerini geliştirebilirler.'
                                        ],
                                        ]]
                                ];
                            @endphp

                            @foreach ($cities as $city)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border-1 city_card rounded-4">
                                        <div class="card-body p-4">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="card-title fw-bold mb-4">
                                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $city['name'] }}
                                                </h5>
                                                <button class="btn btn-sm btnDetail fs-6 fw-semibold" data-bs-toggle="modal" data-bs-target="#cityModal{{ $loop->index }}">Detay</button>
                                            </div>
                                           

                                            {{-- Etiketler --}}
                                            <div class="mb-3">
                                                @foreach ($city['tags'] as $tag)
                                                    <span class="badge text-dark   me-1">{{ $tag }}</span>
                                                @endforeach
                                            </div>

                                            {{-- Bilgiler --}}
                                            <ul class="list-unstyled mb-3">
                                                <li><i class="bi bi-house-door-fill me-2 text-success"></i><strong>Kira (1+0):</strong> {{ $city['rent'] }}</li>
                                                <li><i class="bi bi-building-fill-check me-2 text-info"></i><strong>KYK Kapasitesi:</strong> {{ $city['kyk'] }}</li>
                                                <li><i class="bi bi-link-45deg me-2 text-muted"></i><strong>Kaynak:</strong> <a href="#" class="text-decoration-none text-muted">{{ $city['source'] }}</a></li>
                                            </ul>

                                            {{-- Yıldız Puanı --}}
                                            <div>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $city['rating'])
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                    @else
                                                        <i class="bi bi-star text-secondary"></i>
                                                    @endif
                                                @endfor
                                                <small class="text-muted ms-2">({{ $city['rating'] }}/5)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $iconColors = [
                                        'fa-user-graduate' => '#28a745', 
                                        'fa-home' => '#17a2b8',
                                        'fa-bed' => '#ffc107', 
                                        'fa-plane-departure' => '#dc3545', 
                                        'fa-utensils' => '#6f42c1', 
                                        'fas fa-theater-masks' => '#fd7e14',
                                    ];
                                @endphp
                                <div class="modal fade" id="cityModal{{ $loop->index }}" tabindex="-1" aria-labelledby="cityModalLabel{{ $loop->index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <img src="{{ asset('university logos/'.$uni['logo']) }}" alt="üniversite Logosu"
                                                class="mb-2 me-3" style="height: 50px; object-fit: contain;"> --}}
                                                <h5 class="modal-title" id="cityModalLabel{{ $loop->index }}"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>{{ $city['name'] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                                            </div>
                                            <div class="modal-body px-5 py-4">
                                                @if (isset($city['descriptions']))
                                                    @foreach ($city['descriptions'] as $desc)
                                                     @php
                                                        $iconClass = $desc['icon'];
                                                        $iconColor = $iconColors[$iconClass] ?? '#007bff'; 
                                                    @endphp
                                                        <div class="mb-3">
                                                            <summary style="font-weight: bold; cursor: pointer; display: flex; align-items: center;">
                                                                <i class="fa {{ $iconClass }}" style="margin-right: 10px; color: {{ $iconColor }};"></i>
                                                                {{ $desc['title'] }}
                                                            </summary>
                                                            <p class="mt-2" style="white-space: pre-line;">{!! $desc['content'] !!}</p>

                                                        </div>
                                                    @endforeach                                        
                                                @endif                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

<div class="container my-5 p-0">
    <div class="airport-section-header text-center mb-5">
        <div class="header-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#001b48" stroke-width="1.5">
                <path d="M17.8 19.2L16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
            </svg>
        </div>
        <h2 class="minimal-section-title">Havaalanı Bulunan Şehirler</h2>
        <p class="minimal-section-desc">Öğrenci dostu havaalanları, ulaşım bilgileri ve bilet karşılaştırma araçları</p>
    </div>

    {{-- Quick Search Tools --}}
    <div class="search-tools-bar">
        <h3 class="tools-title">Uçak Bileti Karşılaştırma Araçları</h3>
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-sm-6">
                <a href="https://www.skyscanner.com.tr/" target="_blank" class="tool-card">
                    <div class="tool-icon">🔍</div>
                    <div class="tool-name">Skyscanner</div>
                    <p class="tool-desc">En uygun fiyatları bul</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="https://www.enuygun.com/ucak-bileti/" target="_blank" class="tool-card">
                    <div class="tool-icon">💰</div>
                    <div class="tool-name">Enuygun</div>
                    <p class="tool-desc">Türkiye'nin en ucuzu</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="https://www.obilet.com/ucak-bileti" target="_blank" class="tool-card">
                    <div class="tool-icon">🎫</div>
                    <div class="tool-name">Obilet</div>
                    <p class="tool-desc">Hızlı karşılaştırma</p>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="https://www.googleflights.com/" target="_blank" class="tool-card">
                    <div class="tool-icon">✈️</div>
                    <div class="tool-name">Google Flights</div>
                    <p class="tool-desc">Fiyat takibi</p>
                </a>
            </div>
        </div>
    </div>

    {{-- Filtre --}}
    <div class="minimal-filter-bar">
        <button class="minimal-filter-btn active" data-filter="all">Tümü</button>
        <button class="minimal-filter-btn" data-filter="international">Uluslararası</button>
        <button class="minimal-filter-btn" data-filter="domestic">İç Hat</button>
    </div>

    {{-- Havaalanı Kartları --}}
    <div class="row g-3" id="airportCards">
        @php
            $airports = [
                [
                    'city' => 'İstanbul',
                    'airport' => 'İstanbul Havalimanı',
                    'code' => 'IST',
                    'type' => 'international',
                    'students' => '1.034.553',
                    'universities' => '61 üniversite',
                    'daily_flights' => '1.300+',
                    'destinations' => '309 nokta',
                    'campus_distance' => '30-60 dk',
                    'transport' => 'Metro (M11), Havaist, İETT Otobüs',
                    'transport_cost' => '15-50 TL',
                    'student_discount' => 'THY: %25 | Pegasus: %30 | AnadoluJet: %20',
                    'peak_hours' => '06:00-09:00, 17:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Çalışma Alanları, Şarj İstasyonları, Yemek Alanı',
                    'nearby_unis' => ['Boğaziçi Ünv.', 'İTÜ', 'İstanbul Ünv.', 'Yıldız Teknik', 'Marmara Ünv.'],
                    'job_info' => 'Havacılık, lojistik, turizm ve yer hizmetlerinde yıllık 20.000+ staj pozisyonu',
                    'tips' => 'İstanbul Kartınızla %50 indirimli ulaşım. Sabah 6-9 arası uçuşlar genelde daha ucuz.',
                    'source' => 'İGA, YÖK, DHMİ 2024'
                ],
                [
                    'city' => 'Ankara',
                    'airport' => 'Esenboğa Havalimanı',
                    'code' => 'ESB',
                    'type' => 'international',
                    'students' => '500.000+',
                    'universities' => '25 üniversite',
                    'daily_flights' => '300+',
                    'destinations' => '65 nokta',
                    'campus_distance' => '25-45 dk',
                    'transport' => 'Belko Havaş, EGO Otobüs (442 nolu)',
                    'transport_cost' => '15-35 TL',
                    'student_discount' => 'THY: %25 | AnadoluJet: %20 | Pegasus: %20',
                    'peak_hours' => '07:00-09:00, 18:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Sessiz Çalışma Alanı, Öğrenci Lounge, Kütüphane Köşesi',
                    'nearby_unis' => ['ODTÜ', 'Hacettepe', 'Bilkent', 'Ankara Ünv.', 'Gazi Ünv.'],
                    'job_info' => 'Havacılık mühendisliği, yer hizmetleri, kargo operasyonlarında 12.000+ fırsat',
                    'tips' => 'Ankarakart ile %50 indirim. Çarşamba uçuşları genelde %30 daha ucuz.',
                    'source' => 'TAV, YÖK, DHMİ 2024'
                ],
                [
                    'city' => 'İzmir',
                    'airport' => 'Adnan Menderes Havalimanı',
                    'code' => 'ADB',
                    'type' => 'international',
                    'students' => '154.000+',
                    'universities' => '9 üniversite',
                    'daily_flights' => '280+',
                    'destinations' => '61 nokta',
                    'campus_distance' => '20-40 dk',
                    'transport' => 'İZBAN (Tren), Metro, Havaş, ESHOT',
                    'transport_cost' => '12-30 TL',
                    'student_discount' => 'THY: %25 | Pegasus: %20 | SunExpress: %15',
                    'peak_hours' => '06:00-08:00, 17:00-19:00',
                    'facilities' => 'Ücretsiz WiFi, Deniz Manzaralı Bekleme, Çalışma Masaları, Kafe',
                    'nearby_unis' => ['Ege Ünv.', 'Dokuz Eylül', 'İzmir Ekonomi', 'İzmir Yüksek Teknoloji', 'Yaşar Ünv.'],
                    'job_info' => 'Lojistik, turizm, denizcilik sektöründe 8.000+ staj ve part-time imkan',
                    'tips' => 'İzmirim Kart ile %50 indirim. Mayıs-Eylül arası fiyatlar %40 artıyor.',
                    'source' => 'TAV, YÖK, DHMİ 2024'
                ],
                [
                    'city' => 'Antalya',
                    'airport' => 'Antalya Havalimanı',
                    'code' => 'AYT',
                    'type' => 'international',
                    'students' => '80.000+',
                    'universities' => '5 üniversite',
                    'daily_flights' => '400+',
                    'destinations' => '180+ nokta',
                    'campus_distance' => '15-35 dk',
                    'transport' => 'Tramvay (Havalimanı Hattı), Havaş, Antobus',
                    'transport_cost' => '10-25 TL',
                    'student_discount' => 'THY: %25 | Pegasus: %30 (sezon dışı) | AnadoluJet: %20',
                    'peak_hours' => 'Yaz: 24 saat yoğun | Kış: 08:00-12:00, 16:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Plaj Teması Dinlenme, Turistik Alan, Çalışma Köşeleri',
                    'nearby_unis' => ['Akdeniz Ünv.', 'Alanya Alaaddin Keykubat', 'Antalya Bilim ve Teknoloji'],
                    'job_info' => 'Turizm ve otelcilik sektöründe yaz sezonu 15.000+ staj, yıl boyu 5.000+ part-time',
                    'tips' => 'Ekim-Mart arası %50 daha ucuz. AntalyaKart ile toplu taşıma indirimi.',
                    'source' => 'Fraport TAV, YÖK 2024'
                ],
                [
                    'city' => 'Adana',
                    'airport' => 'Şakirpaşa Havalimanı',
                    'code' => 'ADA',
                    'type' => 'domestic',
                    'students' => '95.000+',
                    'universities' => '6 üniversite',
                    'daily_flights' => '65+',
                    'destinations' => '15 nokta',
                    'campus_distance' => '15-25 dk',
                    'transport' => 'Metro (M1 Hattı), Havaş, Belediye Otobüs',
                    'transport_cost' => '8-20 TL',
                    'student_discount' => 'THY: %25 | AnadoluJet: %20 | Pegasus: %15',
                    'peak_hours' => '07:00-09:00, 18:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Kompakt Terminal, Hızlı Check-in',
                    'nearby_unis' => ['Çukurova Ünv.', 'Adana Bilim ve Teknoloji', 'TED Ünv.'],
                    'job_info' => 'Tarım teknolojisi, tekstil ve lojistik alanında 4.000+ staj fırsatı',
                    'tips' => 'AdanaKart ile %50 indirim. Hafta içi uçuşlar %25 daha uygun.',
                    'source' => 'DHMİ, YÖK 2024'
                ],
                [
                    'city' => 'Trabzon',
                    'airport' => 'Trabzon Havalimanı',
                    'code' => 'TZX',
                    'type' => 'domestic',
                    'students' => '65.000+',
                    'universities' => '3 üniversite',
                    'daily_flights' => '50+',
                    'destinations' => '12 nokta',
                    'campus_distance' => '8-20 dk',
                    'transport' => 'Havaş, Dolmuş, Belediye Otobüs',
                    'transport_cost' => '10-15 TL',
                    'student_discount' => 'THY: %25 | Pegasus: %20 | AnadoluJet: %15',
                    'peak_hours' => '06:00-08:00, 17:00-19:00',
                    'facilities' => 'Ücretsiz WiFi, Deniz Manzarası, Çay Bahçesi',
                    'nearby_unis' => ['KTÜ', 'Avrasya Ünv.', 'Trabzon Ünv.'],
                    'job_info' => 'Denizcilik, balıkçılık ve kara lojistiği alanında 3.000+ kariyer imkanı',
                    'tips' => 'Kampüse çok yakın. Cuma-Pazar uçuşları daha pahalı.',
                    'source' => 'DHMİ, YÖK 2024'
                ],
                [
                    'city' => 'Gaziantep',
                    'airport' => 'Oğuzeli Havalimanı',
                    'code' => 'GZT',
                    'type' => 'domestic',
                    'students' => '120.000+',
                    'universities' => '4 üniversite',
                    'daily_flights' => '45+',
                    'destinations' => '14 nokta',
                    'campus_distance' => '25-40 dk',
                    'transport' => 'Havaş, GAZIULAŞ Otobüs',
                    'transport_cost' => '12-25 TL',
                    'student_discount' => 'THY: %25 | Pegasus: %20 | AnadoluJet: %20',
                    'peak_hours' => '06:00-09:00, 17:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Modern Terminal, Yerel Lezzetler',
                    'nearby_unis' => ['Gaziantep Ünv.', 'Hasan Kalyoncu', 'Sanko Ünv.', 'Gaziantep İslam Bilim ve Teknoloji'],
                    'job_info' => 'Sanayi, dış ticaret, tekstil sektöründe 6.500+ staj ve iş imkanı',
                    'tips' => 'Sanayi şehri olduğundan iş uçuşları yoğun. Öğleden sonra daha uygun.',
                    'source' => 'DHMİ, YÖK 2024'
                ],
                [
                    'city' => 'Konya',
                    'airport' => 'Konya Havalimanı',
                    'code' => 'KYA',
                    'type' => 'domestic',
                    'students' => '200.000+',
                    'universities' => '5 üniversite',
                    'daily_flights' => '40+',
                    'destinations' => '10 nokta',
                    'campus_distance' => '15-30 dk',
                    'transport' => 'Tramvay, Havaş, Belediye Otobüs',
                    'transport_cost' => '8-18 TL',
                    'student_discount' => 'THY: %25 | AnadoluJet: %20 | Pegasus: %15',
                    'peak_hours' => '07:00-09:00, 18:00-20:00',
                    'facilities' => 'Ücretsiz WiFi, Mevlana Temalı Dekor, Sessiz Alanlar',
                    'nearby_unis' => ['Selçuk Ünv.', 'Necmettin Erbakan', 'KTO Karatay', 'Konya Teknik', 'Konya Gıda ve Tarım'],
                    'job_info' => 'Otomotiv, sanayi ve teknoparkta 5.000+ staj pozisyonu',
                    'tips' => 'KonyaKart ile %50 indirim. Salı günleri genelde %20 daha uygun.',
                    'source' => 'DHMİ, YÖK 2024'
                ]
            ];
        @endphp

        @foreach($airports as $airport)
            <div class="col-lg-6 airport-item-wrapper" data-type="{{ $airport['type'] }}">
                <div class="minimal-airport-card">
                    {{-- Header --}}
                    <div class="card-header-minimal">
                        <div class="header-left">
                            <h3 class="city-title">{{ $airport['city'] }}</h3>
                            <p class="airport-subtitle">{{ $airport['airport'] }}</p>
                        </div>
                        <div class="header-right">
                            <span class="code-badge">{{ $airport['code'] }}</span>
                            @if($airport['type'] === 'international')
                                <span class="type-badge">🌍 Uluslararası</span>
                            @else
                                <span class="type-badge domestic">🇹🇷 İç Hat</span>
                            @endif
                        </div>
                    </div>

                    {{-- Main Info --}}
                    <div class="card-info-section">
                        <div class="info-item-minimal">
                            <span class="info-icon-minimal">👨‍🎓</span>
                            <div class="info-content-minimal">
                                <span class="info-label-minimal">Öğrenci Sayısı</span>
                                <span class="info-value-minimal">{{ $airport['students'] }}</span>
                            </div>
                        </div>
                        <div class="info-item-minimal">
                            <span class="info-icon-minimal">✈️</span>
                            <div class="info-content-minimal">
                                <span class="info-label-minimal">Günlük Uçuş</span>
                                <span class="info-value-minimal">{{ $airport['daily_flights'] }}</span>
                            </div>
                        </div>
                        <div class="info-item-minimal">
                            <span class="info-icon-minimal">🌍</span>
                            <div class="info-content-minimal">
                                <span class="info-label-minimal">Uçuş Noktası</span>
                                <span class="info-value-minimal">{{ $airport['destinations'] }}</span>
                            </div>
                        </div>
                        <div class="info-item-minimal">
                            <span class="info-icon-minimal">🏫</span>
                            <div class="info-content-minimal">
                                <span class="info-label-minimal">Üniversite</span>
                                <span class="info-value-minimal">{{ $airport['universities'] }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Transport --}}
                    <div class="detail-section-minimal">
                        <div class="section-title-minimal">🚌 Ulaşım Bilgileri</div>
                        <div class="detail-row">
                            <span class="detail-label">Kampüse Mesafe:</span>
                            <span class="detail-value">{{ $airport['campus_distance'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Ulaşım Araçları:</span>
                            <span class="detail-value">{{ $airport['transport'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Ulaşım Ücreti:</span>
                            <span class="detail-value">{{ $airport['transport_cost'] }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Yoğun Saatler:</span>
                            <span class="detail-value">{{ $airport['peak_hours'] }}</span>
                        </div>
                    </div>

                    {{-- Student Discounts --}}
                    <div class="detail-section-minimal highlight">
                        <div class="section-title-minimal">🎓 Öğrenci İndirimleri</div>
                        <p class="discount-info">{{ $airport['student_discount'] }}</p>
                    </div>

                    {{-- Facilities --}}
                    <div class="detail-section-minimal">
                        <div class="section-title-minimal">🏢 Havaalanı İmkanları</div>
                        <p class="facility-text">{{ $airport['facilities'] }}</p>
                    </div>

                    {{-- Universities --}}
                    <div class="detail-section-minimal">
                        <div class="section-title-minimal">📚 Yakın Üniversiteler</div>
                        <div class="uni-tags-minimal">
                            @foreach($airport['nearby_unis'] as $uni)
                                <span class="uni-tag-minimal">{{ $uni }}</span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Career --}}
                    <div class="detail-section-minimal">
                        <div class="section-title-minimal">💼 Kariyer Fırsatları</div>
                        <p class="career-text">{{ $airport['job_info'] }}</p>
                    </div>

                    {{-- Tips --}}
                    <div class="tips-box-minimal">
                        <span class="tip-icon-minimal">💡</span>
                        <p class="tip-text-minimal">{{ $airport['tips'] }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="card-actions-minimal">
                        <a href="https://www.skyscanner.com.tr/ucak-bileti/{{ strtolower($airport['city']) }}" target="_blank" class="action-btn-minimal primary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path d="m21 21-4.35-4.35"/>
                            </svg>
                            Bilet Ara (Skyscanner)
                        </a>
                        <a href="https://www.enuygun.com/ucak-bileti/" target="_blank" class="action-btn-minimal">
                            Enuygun'da Karşılaştır
                        </a>
                    </div>

                    {{-- Source --}}
                    <div class="source-minimal">
                        <small>📊 Kaynak: {{ $airport['source'] }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Öğrenci Rehberi --}}
    <div class="student-guide-section">
        <h3 class="guide-title">📖 Öğrenciler İçin Uçak Bileti Rehberi</h3>
        
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="guide-box">
                    <h4>💰 Nasıl Ucuz Bilet Bulunur?</h4>
                    <ul class="guide-list">
                        <li><strong>2-3 ay önceden al:</strong> Erken rezervasyon %30-40 tasarruf sağlar</li>
                        <li><strong>Salı-Çarşamba uç:</strong> Hafta ortası uçuşlar %25 daha ucuz</li>
                        <li><strong>Sabah erken/gece geç:</strong> Bu saatlerde uçmak daha ekonomik</li>
                        <li><strong>Karşılaştır:</strong> Skyscanner, Enuygun, Google Flights'ı karşılaştır</li>
                        <li><strong>Fiyat takibi yap:</strong> Google Flights'ta fiyat alarmı kur</li>
                        <li><strong>Gizli mod kullan:</strong> Tarayıcı gizli modda ara (fiyatlar artmasın)</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="guide-box">
                    <h4>🎓 Öğrenci İndirimi Nasıl Alınır?</h4>
                    <ul class="guide-list">
                        <li><strong>Gerekli belgeler:</strong> Öğrenci kimliği + Öğrenci belgesi</li>
                        <li><strong>THY:</strong> 12-24 yaş arası %25 indirim (Youth Ticket)</li>
                        <li><strong>Pegasus:</strong> Öğrenci üyeliği ile kampanyalardan haberdar ol</li>
                        <li><strong>AnadoluJet:</strong> Genç yolcu indirimi %20</li>
                        <li><strong>Rezervasyon:</strong> Web sitesinden veya mobil uygulamadan yap</li>
                        <li><strong>Check-in:</strong> Havalimanında öğrenci belgeni göster</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="quick-tip-box">
                    <div class="tip-number">1</div>
                    <h5>Kampüs Kartı Avantajı</h5>
                    <p>Havalimanına toplu taşıma ile giderken öğrenci kartınla %50 indirim al.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="quick-tip-box">
                    <div class="tip-number">2</div>
                    <h5>Bagaj Limiti</h5>
                    <p>Kabinli biletlerde 8kg ücretsiz. Bavul için ek ücret ödeme.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="quick-tip-box">
                    <div class="tip-number">3</div>
                    <h5>Erken Check-in</h5>
                    <p>Online check-in yap, havalimanında 2 saat önceden ol.</p>
                </div>
            </div>
        </div>
    </div>
</div>


                    {{-- 2024 Yılı Öğrenci Yaşam Giderleri - Aylık Ortalama --}}
                    <div class="d-flex justify-content-between mb-3">
                        <span class="content-title">2024 Yılı Öğrenci Yaşam Giderleri - Aylık Ortalama</span>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/istanbul.jpg') }}" alt="istanbul">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">İstanbul</h3>
                                        <h4 class="card-location">15.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/ankara.jpeg') }}" alt="ankara">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Ankara</h3>
                                        <h4 class="card-location">12.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/izmir.jpg') }}" alt="izmir">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">İzmir</h3>
                                        <h4 class="card-location">11.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/bursa.jpg') }}" alt="bursa">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Bursa</h3>
                                        <h4 class="card-location">10.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/konya.jpg') }}" alt="konya">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Konya</h3>
                                        <h4 class="card-location">9.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-4">
                            <div class="card-container">
                                <div class="card-image">
                                    <img src="{{ asset('cities/adana.jpg') }}" alt="adana">
                                </div>
                                <div class="card-overlay">
                                    <div class="card-content">
                                        <h3 class="card-title">Adana</h3>
                                        <h4 class="card-location">8.000 ₺</h4>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>

                    {{-- 2024 Kültürel Etkinlikler: Şehirlerdeki Sosyal Yaşam ve Fırsatlar --}}
                    <div class="d-flex justify-content-between mt-5 mb-3">
                        <span class="content-title">2024 Kültürel Etkinlikler: Şehirlerdeki Sosyal Yaşam ve Fırsatlar</span>
                    </div>

                    <div class="table-responsive mb-5">
                        <table class="table table-hover table-striped align-middle text-center shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <thead class="bg-dark text-light">
                                <tr style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <th style="padding: 15px;">Şehir</th>
                                    <th>🎵 Konserler ve Müzik</th>
                                    <th>🎭 Tiyatro</th>
                                    <th>🎨 Sergiler</th>
                                    <th>🤝 Sosyal Sorumluluk</th>
                                    <th>⚽ Spor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>İstanbul</strong></td>
                                    <td>
                                        <p>50+ öğrenci konseri</p>
                                        <p>15 büyük sanatçı etkinliği</p>
                                    </td>
                                    <td>
                                        <p>30+ tiyatro gösterimi</p>
                                        <p>10 tiyatro kulübü etkinliği</p>
                                    </td>
                                    <td>
                                        <p>20+ sanat sergisi</p>
                                        <p>10 öğrenci sanat etkinliği</p>
                                    </td>
                                    <td>
                                        <p>8 sosyal sorumluluk projesi</p>
                                        <p>5 çevre temizliği etkinliği</p>
                                    </td>
                                    <td>
                                        <p>10+ üniversite içi spor turnuvası</p>
                                        <p>3 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ankara</strong></td>
                                    <td>
                                        <p>25+ konser etkinliği</p>
                                        <p>10 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>15 tiyatro gösterimi</p>
                                        <p>8 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>12+ sanat sergisi</p>
                                        <p>7 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 sosyal sorumluluk projesi</p>
                                        <p>3 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>İzmir</strong></td>
                                    <td>
                                        <p>20+ konser etkinliği</p>
                                        <p>8 büyük sanatçı etkinliği</p>
                                    </td>
                                    <td>
                                        <p>18 tiyatro gösterimi</p>
                                        <p>6 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>15+ sanat sergisi</p>
                                        <p>5 öğrenci sanat etkinliği</p>
                                    </td>
                                    <td>
                                        <p>10 sosyal sorumluluk projesi</p>
                                        <p>4 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>8 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Bursa</strong></td>
                                    <td>
                                        <p>15+ konser etkinliği</p>
                                        <p>6 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>12 tiyatro gösterimi</p>
                                        <p>5 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>10+ sanat sergisi</p>
                                        <p>3 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>7 sosyal sorumluluk projesi</p>
                                        <p>4 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>6 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Konya</strong></td>
                                    <td>
                                        <p>10+ konser etkinliği</p>
                                        <p>5 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>8 tiyatro gösterimi</p>
                                        <p>4 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>6+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Antalya</strong></td>
                                    <td>
                                        <p>18+ konser etkinliği</p>
                                        <p>7 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>14 tiyatro gösterimi</p>
                                        <p>5 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>12+ sanat sergisi</p>
                                        <p>4 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>6 sosyal sorumluluk projesi</p>
                                        <p>3 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Eskişehir</strong></td>
                                    <td>
                                        <p>10+ konser etkinliği</p>
                                        <p>4 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>7 tiyatro gösterimi</p>
                                        <p>3 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>5+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Trabzon</strong></td>
                                    <td>
                                        <p>8+ konser etkinliği</p>
                                        <p>4 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>6 tiyatro gösterimi</p>
                                        <p>2 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>5+ sanat sergisi</p>
                                        <p>1 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>2 sosyal sorumluluk projesi</p>
                                        <p>1 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>3 üniversite içi spor turnuvası</p>
                                        <p>1 büyük maraton</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Kayseri</strong></td>
                                    <td>
                                        <p>12+ konser etkinliği</p>
                                        <p>6 öğrenci konseri</p>
                                    </td>
                                    <td>
                                        <p>9 tiyatro gösterimi</p>
                                        <p>3 öğrenci tiyatrosu</p>
                                    </td>
                                    <td>
                                        <p>8+ sanat sergisi</p>
                                        <p>2 özel sergi etkinliği</p>
                                    </td>
                                    <td>
                                        <p>4 sosyal sorumluluk projesi</p>
                                        <p>2 çevre etkinliği</p>
                                    </td>
                                    <td>
                                        <p>5 üniversite içi spor turnuvası</p>
                                        <p>2 büyük maraton</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>   


            </div>

        </div>

    </div>
  
@endsection 

@section('css')
<style>
/* ========== VARIABLES ========== */
:root {
    --primary-color: #001b48;
    --bg-white: #ffffff;
    --text-primary: #0f172a;
    --text-secondary: #64748b;
    --text-light: #94a3b8;
    --border-color: #e2e8f0;
    --bg-light: #f8fafc;
}

/* ========== SECTION HEADER ========== */
.airport-section-header {
    padding: 20px 0;
}

.header-icon {
    margin-bottom: 16px;
}

.minimal-section-title {
    font-size: 28px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 8px;
}

.minimal-section-desc {
    font-size: 15px;
    color: var(--text-secondary);
    max-width: 700px;
    margin: 0 auto;
}

/* ========== SEARCH TOOLS ========== */
.search-tools-bar {
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 24px;
    margin-bottom: 32px;
}

.tools-title {
    font-size: 18px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 16px;
    text-align: center;
}

.tool-card {
    display: block;
    background: var(--bg-white);
    border: 2px solid var(--border-color);
    border-radius: 8px;
    padding: 16px;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
}

.tool-card:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,27,72,0.1);
}

.tool-icon {
    font-size: 32px;
    margin-bottom: 8px;
}

.tool-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 4px;
}

.tool-desc {
    font-size: 12px;
    color: var(--text-secondary);
    margin: 0;
}

/* ========== FILTER ========== */
.minimal-filter-bar {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-bottom: 32px;
    flex-wrap: wrap;
}

.minimal-filter-btn {
    padding: 10px 24px;
    background: var(--bg-white);
    border: 2px solid var(--border-color);
    border-radius: 6px;
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
}

.minimal-filter-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.minimal-filter-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: var(--bg-white);
}

/* ========== AIRPORT CARDS ========== */
.minimal-airport-card {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 20px;
    height: 100%;
    transition: all 0.2s;
}

.minimal-airport-card:hover {
    box-shadow: 0 4px 12px rgba(0,27,72,0.08);
}

.card-header-minimal {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--bg-light);
    margin-bottom: 16px;
}

.city-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0 0 4px 0;
}

.airport-subtitle {
    font-size: 13px;
    color: var(--text-secondary);
    margin: 0;
}

.code-badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    color: var(--primary-color);
    background: var(--bg-light);
    padding: 4px 10px;
    border-radius: 4px;
    letter-spacing: 1px;
}

.type-badge {
    display: block;
    font-size: 10px;
    font-weight: 600;
    color: var(--primary-color);
    background: var(--bg-light);
    padding: 3px 8px;
    border-radius: 4px;
    margin-top: 6px;
    text-align: center;
}

.type-badge.domestic {
    color: var(--text-secondary);
}

/* ========== INFO SECTION ========== */
.card-info-section {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
    margin-bottom: 16px;
}

.info-item-minimal {
    display: flex;
    gap: 10px;
    padding: 10px;
    background: var(--bg-light);
    border-radius: 6px;
}

.info-icon-minimal {
    font-size: 20px;
    flex-shrink: 0;
}

.info-content-minimal {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.info-label-minimal {
    font-size: 11px;
    color: var(--text-light);
    font-weight: 500;
}

.info-value-minimal {
    font-size: 13px;
    color: var(--text-primary);
    font-weight: 700;
}

/* ========== DETAIL SECTIONS ========== */
.detail-section-minimal {
    margin-bottom: 16px;
    padding: 12px;
    background: var(--bg-light);
    border-radius: 6px;
}

.detail-section-minimal.highlight {
    background: #f0f4ff;
    border: 1px solid var(--primary-color);
}

.section-title-minimal {
    font-size: 13px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 8px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    font-size: 12px;
    margin-bottom: 6px;
}

.detail-row:last-child {
    margin-bottom: 0;
}

.detail-label {
    color: var(--text-secondary);
    font-weight: 500;
}

.detail-value {
    color: var(--text-primary);
    font-weight: 600;
    text-align: right;
}

.discount-info,
.facility-text,
.career-text {
    font-size: 12px;
    color: var(--text-primary);
    line-height: 1.5;
    margin: 0;
}

.uni-tags-minimal {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.uni-tag-minimal {
    font-size: 11px;
    font-weight: 600;
    color: var(--primary-color);
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    padding: 4px 8px;
    border-radius: 4px;
}

/* ========== TIPS BOX ========== */
.tips-box-minimal {
    display: flex;
    gap: 10px;
    padding: 12px;
    background: #fffbeb;
    border: 1px solid #fbbf24;
    border-radius: 6px;
    margin-bottom: 16px;
}

.tip-icon-minimal {
    font-size: 20px;
    flex-shrink: 0;
}

.tip-text-minimal {
    font-size: 12px;
    color: var(--text-primary);
    line-height: 1.5;
    margin: 0;
}

/* ========== ACTIONS ========== */
.card-actions-minimal {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
}

.action-btn-minimal {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 16px;
    background: var(--bg-white);
    border: 2px solid var(--primary-color);
    border-radius: 6px;
    color: var(--primary-color);
    font-weight: 600;
    font-size: 13px;
    text-decoration: none;
    transition: all 0.2s;
}

.action-btn-minimal:hover {
    background: var(--bg-light);
}

.action-btn-minimal.primary {
    background: var(--primary-color);
    color: var(--bg-white);
}

.action-btn-minimal.primary:hover {
    background: #00152e;
}

.source-minimal {
    text-align: center;
    padding-top: 12px;
    border-top: 1px solid var(--border-color);
}

.source-minimal small {
    font-size: 11px;
    color: var(--text-light);
}

/* ========== GUIDE SECTION ========== */
.student-guide-section {
    background: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 32px;
    margin-top: 48px;
}

.guide-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--primary-color);
    text-align: center;
    margin-bottom: 24px;
}

.guide-box {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 20px;
    height: 100%;
}

.guide-box h4 {
    font-size: 16px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 12px;
}

.guide-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.guide-list li {
    font-size: 13px;
    color: var(--text-primary);
    line-height: 1.6;
    margin-bottom: 8px;
    padding-left: 20px;
    position: relative;
}

.guide-list li:before {
    content: "→";
    position: absolute;
    left: 0;
    color: var(--primary-color);
    font-weight: 700;
}

.guide-list li strong {
    color: var(--primary-color);
}

.quick-tip-box {
    background: var(--bg-white);
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    height: 100%;
}

.tip-number {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: var(--bg-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 700;
    margin: 0 auto 12px;
}

.quick-tip-box h5 {
    font-size: 14px;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 8px;
}

.quick-tip-box p {
    font-size: 12px;
    color: var(--text-secondary);
    line-height: 1.5;
    margin: 0;
}

/* ========== RESPONSIVE ========== */
@media (max-width: 768px) {
    .minimal-section-title {
        font-size: 24px;
    }

    .card-header-minimal {
        flex-direction: column;
        gap: 12px;
    }

    .card-info-section {
        grid-template-columns: 1fr;
    }

    .card-actions-minimal {
        flex-direction: column;
    }

    .student-guide-section {
        padding: 20px;
    }

    .guide-title {
        font-size: 18px;
    }
}
</style>

    <style>
        .content-wrapper {
            padding:2.75rem 15px !important;
        } 
        .city_card{
            background: #f9fbff;
            border: 1px solid #dcdcdc !important;
        }
        .city_card .card-title{
            color: #000000;
                letter-spacing: 2px;
        }
        .city_card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .city_card .badge {
            font-size: 12px;
            border-radius: 12px;
            padding: 5px 10px;
            background-color: #d2e3ff !important;
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
            padding: 15px 0px;
            
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
        .searchInput{
            border: none;
            border-bottom: 1px solid #e0e0e0;
            border-radius: 0;
            padding: 0;
        }

        .searchInput:focus{
            box-shadow: none;
        }
         .card-container {
            position: relative;
            width: auto; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        .card-image img {
            width: 100%;
            height: 150px;
            display: block;
        }

        .card-overlay {
            position: absolute;
            top: 0;
            right: 0;
            /* bottom: 110px; */
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
      #pagination-container a {
          text-decoration: none; 
          padding: 5px 7px; 
          margin: 0 5px; 
          color: blue; 
          border:none;
      }

      #pagination-container a.active {
          background-color: white !important;
          border-color: #007bff !important;
          /* color: white;  */
      }

      #pagination-container a:hover {
          background-color: #f1f1f1; 
      }

    </style>

    <style>

        .main-content{
            border-left: 1px solid #e0e0e0;
        }

    </style>

    {{-- mobil --}}
    <style>
        @media (max-width: 768px) {
            .main-content{
                border-top: 1px solid #e0e0e0;
                border-left: none;
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
                width: 210px; 
            }
            .city-content-title{
                font-size: 16px !important;
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
$(document).ready(function() {
    // Filter functionality
    $('.minimal-filter-btn').on('click', function() {
        $('.minimal-filter-btn').removeClass('active');
        $(this).addClass('active');
        
        const filter = $(this).data('filter');
        
        if (filter === 'all') {
            $('.airport-item-wrapper').fadeIn(300);
        } else {
            $('.airport-item-wrapper').hide();
            $(`.airport-item-wrapper[data-type="${filter}"]`).fadeIn(300);
        }
    });
});
</script>

    <script>
        $(document).ready(function () {
            function loadCities(page = 1, query = '') {
                $.ajax({
                    url: '/cities/fetch',
                    type: 'GET',
                    data: { page: page, search: query },
                    success: function (response) {
                        
                        let citiesHtml = '';
                        $.each(response.cities.data, function (index, item) {
                            const topicCount = response.cities_topics_count[item.id] || 0;
                            citiesHtml += `
                                <li class="list-group-item universityLi">
                                    <a href="/forum/sehir/${item.slug}" class="text-decoration-none universityTag d-flex justify-content-between">
                                        <span class="topic-title-sub-category">${item.title}</span>
                                        <span class="count">${topicCount}</span>
                                    </a>
                                </li>`;
                        });
                        $('#subcategories-list').html(citiesHtml);
                        $('.mobile-cities-list').html(citiesHtml);

                        // Sayfa bağlantılarını güncelle
                        $('#pagination-container').html(response.links);
                        $('.pagination-container').html(response.links);
                    },
                    error: function () {
                        alert('şehirler yüklenirken bir hata oluştu.');
                    }
                });
            }

            // İlk yükleme
            loadCities();

            // Sayfa bağlantılarına tıklama olayı
            $(document).on('click', '#pagination-container a', function (e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const page = new URL(url).searchParams.get('page');
                const query = $('.searchInput').val();
                loadCities(page, query);
            });

            $(document).on('input', '.searchInput', function () {
                const query = $(this).val();
                console.log(query)
                loadCities(1, query);
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
@endsection
