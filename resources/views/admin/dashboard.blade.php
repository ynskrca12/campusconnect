@extends('admin.master')

@section('title', 'Panel | CampusConenct')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: white !important;
            border: 2px solid #001b48;
            padding: 10px 10px;
            border-left: none;
            border-radius: 0px;
            border-top: none;
            border-bottom: none;
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .sidebar .nav-link {
            font-size: 1.1rem;
            padding: 12px;
            color: #001b48;
        }

        .sidebar .nav-link.active {
            background-color: #001b48;
            color: white;
            border-radius: 10px;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .section-title {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <style>
        .card {
            background-color: #fff;
            border-radius: 10px;
            border: none;
            position: relative;
            margin-bottom: 30px;
            width: 90%;
        }
        .l-bg-cherry {
            background: linear-gradient(to right, #493240, #f09) !important;
            color: #fff;
        }

        .l-bg-blue-dark {
            background: linear-gradient(to right, #373b44, #4286f4) !important;
            color: #fff;
        }

        .l-bg-green-dark {
            background: linear-gradient(to right, #0a504a, #38ef7d) !important;
            color: #fff;
        }

        .l-bg-orange-dark {
            background: linear-gradient(to right, #a86008, #ffba56) !important;
            color: #fff;
        }

        .card .card-statistic-3 .card-icon-large .fas, .card .card-statistic-3 .card-icon-large .far, .card .card-statistic-3 .card-icon-large .fab, .card .card-statistic-3 .card-icon-large .fal {
            font-size: 110px;
        }

        .card .card-statistic-3 .card-icon {
            text-align: center;
            line-height: 50px;
            margin-left: 15px;
            color: #000;
            position: absolute;
            right: -5px;
            top: 20px;
            opacity: 0.1;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }

        .l-bg-green {
            background: linear-gradient(135deg, #23bdb8 0%, #43e794 100%) !important;
            color: #fff;
        }

        .l-bg-orange {
            background: linear-gradient(to right, #f9900e, #ffba56) !important;
            color: #fff;
        }

        .l-bg-cyan {
            background: linear-gradient(135deg, #289cf5, #84c0ec) !important;
            color: #fff;
        }
        .custom-shadow{
            box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Main content -->
            <main class="col-md-12 col-lg-12 px-4">
                <section class="section-title mb-5">
                    <h1 class="h2 text-center">Yönetim Paneli</h1>
                </section>

                <div class="container mt-4">
                    <div class="row ">
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="card l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"></div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fa-solid fa-users me-3"></i>
                                        <h5 class="card-title mb-0">Toplam Kullanıcı</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ $totalUsers }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="card l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"></div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fa-solid fa-comments me-3"></i>
                                        <h5 class="card-title mb-0">Toplam Yapılan Yorum</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ $totalForum }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <div class="card l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"></div>
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="fa-solid fa-pen me-3"></i>
                                        <h5 class="card-title mb-0">Toplam Blog/Makale</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                {{ $totalBlog }}
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row text-center mb-4 mt-5">
                        <div class="col-md-4">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Genel Yorum Sayısı</h5>
                                    <p class="card-text display-6">{{ $totalGeneralForum }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Üniversite Yorum Sayısı</h5>
                                    <p class="card-text display-6">{{ $totalUniversityForum }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <h5 class="card-title">Şehir Yorum Sayısı</h5>
                                    <p class="card-text display-6">{{ $totalCityForum }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </main>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
