<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blog_content = '
           <p>Üniversite tercihi, gençlerin hayatında vereceği en kritik kararlardan biridir. Bu karar sadece eğitim hayatını değil, 
           aynı zamanda sosyal çevreni, kariyer yolculuğunu ve yaşam tarzını da derinden etkiler. Sınav süreci sonrasında tercih 
           döneminde yaşanan kafa karışıklığı son derece doğaldır. Peki, bu süreci daha sağlıklı ve bilinçli şekilde yönetmek için 
           nelere dikkat etmelisin?</p><p>&nbsp;</p><h3>1. <strong>Kendini Tanıyarak Başla</strong></h3><p>Üniversite tercihi 
           yapmadan önce “Ben ne istiyorum?” sorusuna net bir yanıt verebilmelisin. İlgi alanların, güçlü yönlerin ve hayalindeki 
           kariyer hedefi bu süreçte pusulan olmalı. Sırf popüler diye ya da ailenin istediği bir bölümü tercih etmek, uzun vadede 
           mutsuzluk getirebilir.</p><p>🔍 <i>Kendine sor:</i></p><ul><li>Hangi konulara ilgi duyuyorum?</li><li>Hangi alanda çalışmak
            bana heyecan veriyor?</li><li>Sosyal mi, teknik mi bir yapıya sahibim?</li></ul><p>&nbsp;</p><h3>2. <strong>Bölüm Seçimini 
            Bilinçli Yap</strong></h3><p>Bir üniversitenin ismi kadar, tercih ettiğin bölümün içeriği ve sana katacakları da çok 
            önemlidir. Bölümün ders içerikleri, öğretim kadrosu, staj ve iş imkânları gibi unsurları araştırmadan karar verme.</p><p>
            🧠 <i>Dikkat etmen gerekenler:</i></p><ul><li>Bölüm mezunlarının iş bulma oranı nedir?</li><li>Zorunlu staj var mı?</li><li>Erasmus, çift anadal (ÇAP) veya yandal imkânı sunuyor mu?</li></ul><p>&nbsp;</p><h3>3. <strong>Üniversitenin Olanaklarını Araştır</strong></h3><p>Sadece bölüm değil, üniversitenin genel olanakları da kararını etkileyebilir. Geniş bir kampüs, aktif öğrenci kulüpleri, güçlü akademik kadro ve uluslararası bağlantılar, eğitim sürecini daha nitelikli hale getirir.</p><p>🏫 <i>Şunlara dikkat et:</i></p><ul><li>Kütüphane ve laboratuvar olanakları</li><li>Yurt, ulaşım ve yemekhane durumu</li><li>Sosyal yaşam ve etkinlikler</li></ul><p>&nbsp;</p><h3>4. <strong>Şehir Seçimi Göz Ardı Edilmemeli</strong></h3><p>Üniversite eğitimi 4 yıl gibi görünse de, bazen bu süre uzayabilir. Dolayısıyla yaşayacağın şehir, sana sosyal, kültürel ve ekonomik açıdan uygun olmalı. Büyük şehirlerde imkanlar fazla olabilir, ancak yaşam masrafları da yüksektir.</p><p>🌆 <i>Göz önünde bulundur:</i></p><ul><li>Şehirdeki yaşam maliyetleri</li><li>Ulaşım kolaylığı</li><li>Sosyal ve kültürel etkinlik imkanları</li></ul><p>&nbsp;</p><h3>5. <strong>Üniversitenin Vizyonu ve Mezun İlişkileri</strong></h3><p>Bazı üniversiteler sadece eğitim vermez, seni iş dünyasına da hazırlar. Mezunlarına sundukları kariyer desteği, iş bulma ağı (network) ve mezunların başarı hikâyeleri çok şey anlatır.</p><p>📈 <i>Bakılacaklar:</i></p><ul><li>Kariyer merkezi var mı?</li><li>Mezunlarla iletişim ağı güçlü mü?</li><li>Mezun başarı oranları nasıl?</li></ul><p>&nbsp;</p><h3>6. <strong>Sıralama ve Puanla Sınırlı Kalmayın</strong></h3><p>Tercih listeni sadece sıralamana odaklanarak oluşturmak yanıltıcı olabilir. Sıralamalar her yıl değişebilir, bu yüzden "tercih aralığı" mantığıyla yukarıdan aşağı doğru bilinçli bir liste yapmak önemlidir.</p><p>📝 <i>İpucu:</i><br>Tercih listenin ilk sıralarına hayalini kurduğun yerleri, ortalarına sıralamana yakın olanları, son sıralara ise garanti bölümleri yazabilirsin.</p><p>&nbsp;</p><h3>7. <strong>Tecrübelerden Yararlan:</strong></h3><p>CampusConnect gibi platformlarda diğer öğrencilerin deneyimlerini okumak, karar sürecinde sana gerçek ve samimi bilgiler sunar. Üniversitelerin resmi tanıtım videolarının dışında, öğrenci yorumları şehir ve kampüs hayatı hakkında daha net bir tablo çizer.</p><p>👥 <i>Yapılacaklar:</i></p><ul><li>Forumları ve sosyal medya gruplarını takip et</li><li>Mezun ya da mevcut öğrencilere sorular sor</li><li>YouTube vlogları ve kampüs turları izle</li></ul><p>&nbsp;</p><h3>8. <strong>Aile ve Rehber Öğretmen Görüşlerini Al</strong></h3><p>Son karar elbette sana ait olsa da, rehber öğretmeninin ve ailenin görüşlerini almak, sana farklı bakış açıları kazandırabilir. Bazen dışarıdan gelen bir yorum, gözden kaçırdığın bir noktayı fark etmeni sağlar.</p><p>&nbsp;</p><h2>Sonuç: Geleceğini Şansa Bırakma</h2><p>Üniversite tercihi, yalnızca bir eğitim kurumu seçmek değil, aynı zamanda bir yaşam tarzını ve çevreyi de seçmektir. Tercih dönemini doğru yönetmek, ileride “İyi ki bu kararı vermişim” demeni sağlar. Unutma, CampusConnect ailesi olarak bu süreçte her zaman yanında olacağız. Sorularını sor, tecrübelerini paylaş, bilinçli bir tercih için birlikte ilerleyelim!</p>
        ';

        $blog_content2 ='
            <p>Üniversiteye başlamak heyecan verici olduğu kadar, bazen zorlayıcı da olabilir. Yeni bir şehir, yeni insanlar, yeni bir yaşam tarzı… Tüm bunlar başlangıçta seni bir miktar zorlayabilir. Ancak endişelenme, kampüs hayatına alışmak tamamen zamanla gelişen bir süreçtir ve bu süreci daha kolay hale getirecek birkaç ipucu var.</p><h3>1. <strong>Sosyal Çevre Oluştur</strong></h3><p>Üniversiteye başladığında tanımadığın birçok insanla karşılaşacaksın. İlk başta yalnız hissedebilirsin, ancak unutma ki burada herkes yeni bir başlangıç yapıyor. Sosyal çevreni oluşturmak, kampüs hayatına uyum sağlamanın en önemli adımlarından biridir.<br>Farklı öğrenci kulüplerine katılabilir, etkinliklerde yer alabilir veya ders dışı aktivitelerde arkadaşlar edinebilirsin.<br>Böylece yalnızca derslerde değil, sosyal yaşamda da kendine bir yer edinebilirsin.</p><p>🎯 <i>İpucu:</i><br>Sosyal medyada üniversiteye özel gruplara katılmak, yeni insanlarla tanışmanın hızlı bir yoludur.</p><h3>2. <strong>Ders Programını Düzenle</strong></h3><p>Üniversite hayatı, genellikle lise hayatına kıyasla çok daha esnektir. Her şeyin zamanlaması sana bağlıdır. Bu durum, bir yandan özgürlük sunsa da, bir yandan da disiplin gerektirir.<br>Derslerin ve sınavların arasında denge kurarak, zaman yönetimini iyi yapmalısın. Her hafta düzenli olarak ders çalışma planı oluşturman, dersleri ve sınavları rahatça geçmene yardımcı olur.</p><p>📝 <i>İpucu:</i><br>Günlük veya haftalık bir takvim oluşturarak, ders programını ve sosyal etkinliklerini kolayca takip edebilirsin.</p><h3>3. <strong>Yurt ve Kampüs İmkanlarını Keşfet</strong></h3><p>Yaşayacağın yeri ve kampüs olanaklarını iyi keşfetmen de, kampüs hayatına alışmanı kolaylaştırır. Yurt, kantin, kütüphane, spor salonu gibi tüm kampüs imkanlarını gezerek, her biri hakkında bilgi sahibi ol.<br>Kampüs içinde rahatça hareket edebilmek, hem günlük yaşamını kolaylaştırır hem de kampüsün sunduğu imkanlardan faydalanmanı sağlar.</p><p>🚶‍♂️ <i>İpucu:</i><br>Kampüs turları düzenleniyorsa katılabilir veya arkadaşlarınla keşif yapabilirsin.</p><h3>4. <strong>Yalnız Hissettiğinde Yardım İste</strong></h3><p>Kampüse alışmak zaman alabilir. Eğer yalnızlık hissi seni zorlarsa, üniversite danışmanlık servislerine başvurabilirsin. Pek çok üniversite, öğrencilere mental sağlık desteği sunar.<br>Bunlar, öğrenci yaşamına adapte olmanın ve başkalarından yardım almanın tamamen normal olduğu yerlerdir.</p><p>🤝 <i>İpucu:</i><br>Kendini yalnız hissettiğinde arkadaşlarından veya öğretim üyelerinden destek almayı unutma.</p><h3>5. <strong>Kendi Alanını Yarat</strong></h3><p>Kampüs hayatı hızlı ve bazen karmaşık olabilir. Bu yüzden, zaman zaman yalnız kalıp, kafanı dinlemek isteyebilirsin. Kendine ait bir alan oluşturmak, hem mental sağlığını korur hem de verimli çalışmana olanak tanır.<br>Kütüphaneye veya sessiz bir kafeye giderek, ders çalışabilir veya sadece rahatlamak için bir köşe oluşturabilirsin.</p><p>📚 <i>İpucu:</i><br>Kampüsün sakin yerlerini keşfetmek, stresli anlarda senin için kaçış noktaları olabilir.</p><h3>6. <strong>Sosyal Medya ve Teknolojiyi Dengele</strong></h3><p>Sosyal medya, üniversite hayatını takip etmenin bir yolu olabilir, ancak çok fazla vakit harcamamak gerektiğini unutma. Gerçekten önem taşıyan anları kaçırmamak için sosyal medya kullanımını dengeleyerek, gerçek yaşamda daha aktif olabilirsin.</p><p>📱 <i>İpucu:</i><br>Belirli saatlerde sosyal medyayı kontrol ederek, zamanı daha verimli geçirebilirsin.</p><h2>Sonuç: Kampüs Hayatına Adapte Olmak Zaman Alır</h2><p>Üniversiteye başlamak, bazen biraz zaman alabilir ama unutma ki bu süreçte yalnız değilsin. Her öğrenci, kampüs hayatına alışmakta bir noktada zorluk yaşar. Bu nedenle sabırlı olmalı ve her adımda keyif almayı unutmamalısın. CampusConnect olarak, senin bu yolculuğunda sana rehberlik etmekten mutluluk duyuyoruz. Sosyal hayatını keşfet, arkadaşlıklar kur ve üniversitenin sunduğu tüm fırsatlardan yararlan!</p>
        ';

        $blog_content3 = '
           <p>Üniversiteye yeni başladığında seni yepyeni bir dünya bekliyor. Dersler, sınavlar, projeler derken hayat bir anda yoğunlaşabilir. Ama üniversite sadece akademik bir yolculuk değil; aynı zamanda kendini keşfetme, sosyalleşme ve ilgi alanlarını geliştirme sürecidir. İşte bu noktada üniversite kulüpleri devreye giriyor.</p><p>&nbsp;</p><h3>1. <strong>Yeni Arkadaşlıklar Kurmanın En Kolay Yolu</strong></h3><p>Üniversiteye başladığında herkes gibi sen de yeni bir çevreye alışmaya çalışacaksın. Kulüpler, aynı ilgi alanlarına sahip öğrencileri bir araya getirir. Bu sayede arkadaş edinmek hem daha kolay hem de daha keyifli olur.</p><p>🤝 <i>İpucu:</i><br>Katıldığın kulüplerde aktif görev alarak arkadaşlıklarını daha da derinleştirebilirsin.</p><p>&nbsp;</p><h3>2. <strong>Kendini Geliştirme Fırsatı</strong></h3><p>Kulüpler, liderlik becerilerini geliştirme, topluluk önünde konuşma yapma ve organizasyon düzenleme gibi yetkinlikleri kazandırır. Bu beceriler, hem kişisel gelişimin hem de iş hayatın için büyük avantaj sağlar.</p><p>🚀 <i>Örnek:</i><br>Bir kulüpte başkan yardımcılığı yapan bir öğrenci, takım yönetme ve iletişim gibi becerileri erken yaşta öğrenir.</p><p>&nbsp;</p><h3>3. <strong>CV’ne Artı Değer Katar</strong></h3><p>İşverenler, sadece akademik başarıya değil, aynı zamanda sosyal faaliyetlere ve takım çalışmasına da önem verir. Kulüp faaliyetleri, CV\'ni zenginleştirmek için harika bir yoldur. Özellikle aktif görev aldıysan bu detaylar seni rakiplerinden ayırabilir.</p><p>📄 <i>İpucu:</i><br>Kulüpte düzenlediğin etkinlikleri ve üstlendiğin görevleri mutlaka CV’ne eklemeyi unutma.</p><p>&nbsp;</p><h3>4. <strong>Yeni İlgi Alanları Keşfet</strong></h3><p>Belki de müzikle, tiyatroyla veya girişimcilikle hiç ilgilenmemiştin. Ama bir kulübe katıldığında kendinde yeni yetenekler keşfedebilirsin. Üniversite, denemekten korkmaman gereken bir dönemdir.</p><p>🎨 <i>İpucu:</i><br>Farklı kulüplere misafir olarak katıl, hangisinin sana daha çok hitap ettiğini keşfet.</p><p>&nbsp;</p><h3>5. <strong>Etkinlik ve Organizasyon Deneyimi</strong></h3><p>Kulüpler çoğunlukla seminerler, sosyal etkinlikler, kültürel geziler ve daha pek çok organizasyon düzenler. Bu süreçlere dahil olmak, hem eğlenceli hem de öğretici bir deneyimdir.</p><p>🎤 <i>Örnek:</i><br>Konferans organize eden bir öğrenci, bütçe yönetimi, zaman planlaması ve kriz çözme konularında büyük tecrübe kazanır.</p><p>&nbsp;</p><h3>6. <strong>Network Kurma İmkânı</strong></h3><p>Bazı kulüpler sektör profesyonelleriyle seni bir araya getirir. Bu da hem staj hem de mezuniyet sonrası iş fırsatları için önemli bir adım olabilir. Üniversitede kurduğun bu bağlantılar, ileride sana kapılar açabilir.</p><p>📞 <i>İpucu:</i><br>Etkinliklerde konuşmacılarla tanışmaktan çekinme, sosyal medyada bağlantı kur.</p><p>&nbsp;</p><h2>Sonuç: Üniversite Kulüpleri Geleceğine Yatırımdır</h2><p>Üniversite kulüpleri sadece boş vakitleri değerlendirmek için değil; kendini tanımak, geliştirmek ve geleceğine yatırım yapmak için de eşsiz bir fırsattır. CampusConnect olarak seni bu yolculukta destekliyor ve üniversite hayatını dolu dolu geçirmeni diliyoruz. Unutma, her kulüp yeni bir kapı, her etkinlik yeni bir fırsattır!</p>
        ';

        DB::table('blogs')->insert([
            'user_id' => 51,
            'title' => 'Üniversite Tercihi Yaparken Nelere Dikkat Etmeliyim?',
            'slug' => Str::slug('Üniversite Tercihi Yaparken Nelere Dikkat Etmeliyim?' ),
            'category_id' => 1,
            'summary' => 'Üniversite tercihi, geleceğini şekillendiren en önemli adımlardan biridir. Bu yazıda, bilinçli tercihler yapman için dikkat etmen gereken temel faktörleri ele aldık.',
            'content' => $blog_content,
            'cover_image' => 'blog_img/cover_img/default_blog_img.webp',
            'content_image' => 'blog_img/content_img/default_blog_img.webp',
            'view_count' => 0,
            'likes' => 0,
            'dislikes' => 0,
            'seo_title' => 'Üniversite Tercihi Yaparken Dikkat Edilmesi Gerekenler | CampusConnect',
            'seo_description' => 'Üniversite tercih sürecinde dikkat edilmesi gerekenleri öğrenin. Kampüs, şehir, bölüm seçimi gibi kararları daha bilinçli vermek için ipuçları CampusConnect blogunda!',
            'meta_keywords' => 'üniversite tercihi, tercih yaparken nelere dikkat edilmeli, bölüm seçimi, şehir seçimi, üniversite rehberi, YKS, üniversite adayları, üniversite hayatı',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('blogs')->insert([
            'user_id' => 51,
            'title' => 'Kampüs Hayatına Nasıl Alışılır?',
            'slug' => Str::slug('Kampüs Hayatına Nasıl Alışılır?' ),
            'category_id' => 5,
            'summary' => 'Üniversiteye yeni başlayan öğrenciler için kampüs hayatına alışmak zaman alabilir. Bu yazıda, üniversite yaşamına kolayca adapte olmanın yollarını ve ipuçlarını paylaşıyoruz.',
            'content' => $blog_content2,
            'cover_image' => 'blog_img/cover_img/default_blog_img.webp',
            'content_image' => 'blog_img/content_img/default_blog_img.webp',
            'view_count' => 0,
            'likes' => 0,
            'dislikes' => 0,
            'seo_title' => 'Kampüs Hayatına Alışmanın Yolları | CampusConnect',
            'seo_description' => 'Üniversiteye yeni başlayanlar için kampüs hayatına nasıl alışılır? Sosyal hayat, dersler ve kampüs içindeki ilişkiler hakkında bilmen gereken her şey bu blogda!',
            'meta_keywords' => 'kampüs hayatı, üniversite yaşamı, kampüs alışma, öğrenci hayatı, sosyal yaşam, üniversite arkadaşlıkları, ders düzeni, üniversiteye alışma',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('blogs')->insert([
            'user_id' => 51,
            'title' => 'Üniversite Kulüpleri Neden Bu Kadar Önemli?',
            'slug' => Str::slug('Üniversite Kulüpleri Neden Bu Kadar Önemli?' ),
            'category_id' => 9,
            'summary' => 'Üniversite kulüpleri, sadece sosyalleşmek için değil, kişisel gelişim ve kariyer fırsatları için de büyük bir avantaj sağlar. Bu yazımızda kulüplere katılmanın neden bu kadar önemli olduğunu anlatıyoruz.',
            'content' => $blog_content3,
            'cover_image' => 'blog_img/cover_img/default_blog_img.webp',
            'content_image' => 'blog_img/content_img/default_blog_img.webp',
            'view_count' => 0,
            'likes' => 0,
            'dislikes' => 0,
            'seo_title' => 'Üniversite Kulüplerine Katılmanın Faydaları | CampusConnect',
            'seo_description' => 'Üniversite kulüpleri neden bu kadar önemli? Sosyal çevre, liderlik, kariyer fırsatları ve daha fazlası bu blog yazımızda!',
            'meta_keywords' => 'üniversite kulüpleri, öğrenci kulübü, kampüs hayatı, sosyal etkinlikler, liderlik, arkadaşlık, networking, kişisel gelişim',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
