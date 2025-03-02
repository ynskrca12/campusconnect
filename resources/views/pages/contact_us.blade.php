@extends('layouts.master')
@section('content')

    <div class="container">     
        <h2 class="feature-title">
            Bize Ulaşın
        </h2>
        
        <section class="feature-section">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <a href="https://mail.google.com/mail/?view=cm&to=campusconnectiletisim@gmail.com" target="_blank" style="text-decoration: none;">
                            <div class="feature-card">
                                <img src="{{ asset('assets/images/icons/mail-icon.png') }}" class="font-icon" alt="campusconnect mail">
                                    <p class="feature-desc">campusconnectiletisim@gmail.com</p>                                        
                            </div>
                         </a>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="https://x.com/campusconline?t=DCZqePG9GVkGI0o6ukRSog&s=08" target="_blank" style="text-decoration: none;">
                            <div class="feature-card">
                                <img src="{{ asset('assets/images/icons/twitter.png') }}" class="font-icon" alt="campusconnect twitter">
                                <p class="feature-desc">@campusconline</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="https://www.instagram.com/campusconnectonline?utm_source=qr&igsh=M2poMDM1bHJuNmVo" target="_blank" style="text-decoration: none;">
                            <div class="feature-card">
                                <img src="{{ asset('assets/images/icons/instagram.png') }}" class="font-icon" alt="campusconnect instagram">
                                <p class="feature-desc">@campusconnectonline</p>
                            </div>
                        </a>
                    </div>           
            </div>            
        </section>

        <section class="feedback-section py-5">
            <div class="container">
                <h2 class="text-center fw-bold mb-5">Destek, Şikayet ve Öneri</h2>
                
                <div class="row ">
                    <!-- Açıklama Alanı -->
                    <div class="col-md-6">
                        <p class="fs-6 mb-5">
                            Görüşleriniz bizim için çok kıymetli. CampusConnect olarak, en iyi deneyimi sunmak için sürekli gelişmeyi hedefliyoruz. Bize ilettiğiniz şikayetler, öneriler ve talepler hızlı bir şekilde değerlendirilecektir.
                        </p>
                        <p class="fs-6 mb-5">
                            Her zaman bizimle iletişime geçebilir, yaşadığınız sorunları paylaşabilirsiniz. Önerilerinizle platformumuzu daha iyi hale getirmemize yardımcı olabilirsiniz.
                        </p>
                        <p class="fs-6 mb-5">
                            Geri bildirimlerinizi dikkate alarak kendimizi sürekli geliştiriyoruz. CampusConnect olarak, kullanıcı memnuniyetini ön planda tutuyor ve daha iyi bir deneyim sunmayı amaçlıyoruz.
                        </p>
                        
                        
                        
                    </div>
                    
                    <!-- Form Alanı -->
                    <div class="col-md-6">
                        <div class="card rounded-4 p-4" style="border: 1px solid #e3e3e3 !important;box-shadow: 0 1rem 2rem rgba(0, 0, 0, .06) !important;">
                            <form action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        <i class="fas fa-user"></i>&nbsp; Adınız Soyadınız
                                    </label>
                                    <input type="text" class="form-control rounded-3" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope"></i>&nbsp; E-Posta Adresiniz
                                    </label>
                                    <input type="email" class="form-control rounded-3" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label fw-semibold">
                                        <i class="fas fa-comment-dots"></i>&nbsp; Mesajınız
                                    </label>
                                    <textarea class="form-control rounded-3" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Gönder</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
    </div>
@endsection

@section('css')

<style>
    .feature-title{
        text-align: center;
        margin-bottom: 30px;
        color: #000;
        letter-spacing: 1px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }
   
    .feature-section { 
         background: #fff;
 
     }
 
    .feature-card {
         background: #fff;
         backdrop-filter: blur(10px);
         padding: 25px 0px 0px 0px;
         margin: 10px;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         display: flex;
         flex-direction: column;
         height: 100%;
         align-items: center;
         border:1px solid #969696;
         border-radius: 17px;
     }
 
    .feature-card:hover {
         transform: translateY(-10px);
         box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
    }
 
    feature-icon {
         width: 60px;
         height: 60px;
         margin-bottom: 15px;
     } 
 
     .feature-desc {
         font-size: 16px;
         color: #333;
         padding:0 21px;
        text-align: center;
        font-weight: 600;
     }
 
     .row{
         display: flex;
         margin-bottom: 60px;
     }
 
     .font-icon {
        width: 15%;
        margin-bottom: 20px;
     }
     
     @media (max-width: 768px) {
         .row{
             display: block;
             margin-bottom: 0px;
         }
 
         .feature-desc{
             text-align: center;
             font-size: 11px;
         }
 
         
     }

     @media (min-width: 768px) and (max-width: 820px) {
        .feature-desc {
            font-size: 13px;
        }
    }

 
 </style>

<style>
    .feedback-section {
        /* background: linear-gradient(135deg, #001b48, #003366); */
        border-radius: 15px;
    }
    .card {
        background: white;
    }
    .btn-primary {
        background: #001b48;
        border: none;
        transition: 0.3s;
    }
    .btn-primary:hover {
        background: #012d79;
    }
</style>
@endsection

@section('js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

@endsection