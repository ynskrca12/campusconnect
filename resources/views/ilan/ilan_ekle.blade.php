@extends('layouts.master')

@section('content')
@if(Session::has('error'))
<p class="alert alert-info">{{ Session::get('error') }}</p>
@endif
        <div class="container contact-form">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            <form id="addAdvert" action="{{ route('ilan_ekle_post') }}"  method="POST" enctype="multipart/form-data">
                @csrf
                <h3>İlan Ver</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="floatingInput">İlan Başlığı</label>
                            <input type="text" name="name" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label for="floatingInput">Fiyat</label>
                            <input type="number" name="fiyat" class="form-control"   />
                        </div>

                        <div class="form-group">
                            <label for="floatingInput">İlan Kategorisi</label>
                            <select name="category" class="form-control" id="category">
                                <option selected>Seçiniz</option>
                                <option value="İş İlanları">iş İlanı</option>
                                <option value="Ev İlanları">Ev İlanı</option>
                                <option value="Eşya İlanları">Eşya İlanı</option>
                                <option value="Teknolojik Aletler">Teknolojik Alet</option>
                                <option value="Not İlanı">Not İlanı</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="floatingInput">İlan Açıklaması</label>
                            <textarea name="description" class="form-control" style="width: 100%; height: 150px;"></textarea>
                        </div>
                         <div class="form-group">
                            <label for="image">Fotoğraf Ekle</label>
                            <input type="file" name="file" class="form-control"  />
                        </div> -
                    </div>
                </div>


                <div class="row">
                    <div class="form-group">
                        <input type="submit" name="btnSubmit" class="btnContact" value="İlan Ver" />
                    </div>
                </div>


            </form>

            
</div>

@endsection

@section('css')
    <style>

        .content-wrapper{
            /* background: -webkit-linear-gradient(left, #0072ff, #00c6ff); */
            background: -webkit-linear-gradient(left,#001b48,#0072ff) ;
        }
        .contact-form{
            background: -webkit-linear-gradient(left, #fff, #F8F4EC);;
            margin-top: 3%;
            margin-bottom: 5%;
            width: 70%;
        }
        .contact-form .form-control{
            border-radius:1rem;
        }
        .contact-image{
            text-align: center;
        }
        .contact-image img{
            border-radius: 6rem;
            width: 11%;
            margin-top: -3%;
            transform: rotate(29deg);
        }
        .contact-form form{
            padding: 14%;
        }
        .contact-form form .row{
            margin-bottom: -7%;
        }
        .contact-form h3{
            margin-bottom: 8%;
            margin-top: -15%;
            text-align: center;
            color: #001b48;
        }
        .contact-form .btnContact {
            width: 50%;
            border: none;
            border-radius: 1rem;
            padding: 1.5%;
            background:  -webkit-linear-gradient(left, #001b48, #0072ff);
            font-weight: 600;
            color: #fff;
            cursor: pointer;
        }
        .btnContactSubmit
        {
            width: 50%;
            border-radius: 1rem;
            padding: 1.5%;
            color: #fff;
            background-color: #0062cc;
            border: none;
            cursor: pointer;
        }
        .form-control{
            border: 1px solid gray;
        }

        #category {
            border: 1px solid gray;
        }
    </style>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('#addAdvert').on('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if(response.success) {
                            swal({
                                title: "Başarılı!",
                                text: "İlan başarıyla gönderildi. Onay sürecinden sonra yayına alınacaktır.",
                                icon: "success",
                                button: "Tamam",
                            }).then((value) => {
                                if (value) {
                                    location.reload(); // Sayfayı yenile
                                }
                            });
                        }
                    },
                    error: function (response) {
                        swal({
                            title: "Hata!",
                            text: "İlan gönderilirken bir hata oluştu.Lütfen tekrar deneyin.",
                            icon: "error",
                            button: "Tamam",
                        }).then((value) => {
                            if (value) {
                                location.reload(); // Sayfayı yenile
                            }
                        });
                    }
                });
            });
        });
        
    </script>
@endsection
