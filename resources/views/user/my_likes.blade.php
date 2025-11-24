@extends('layouts.master')

@section('content')
  @if(session('success'))
      <div class="alert alert-success">
          {{ session('success') }}
      </div>
  @endif

  <div class="row">
      <!-- Main Content -->
      <div class="col-12">
          <div class="card border-0 mt-0 mt-md-5">
              <div class="card-body p-0">
                  <div class="row g-0">
                      <!-- Sidebar -->
                      <div class="col-lg-3 text-center mb-4 pe-0 pe-md-4">
                        <div class="position-relative d-inline-block">
                            @php 
                                $imageName = $user->user_image;
                                
                                $imagePath = $imageName
                                    ? asset('storage/profile_images/' . $imageName)
                                    : asset('assets/images/icons/user.png');
                            @endphp    
                          <img 
                            style=";width: 70px;height: 70px;object-fit: cover;"
                            src="{{ $imagePath }}"
                            class="rounded-circle profile-pic" alt="Profile Picture">
                      </div>
                      <h5 class="mt-3 mb-1 userName">{{ Auth::user()->name }}</h5>
                              <div class="nav flex-column nav-pills">
                                  <a class="nav-link nav-link-profile active" id="my-likes-tab" href="#" data-target="#myLikes"><i class="fa-solid fa-thumbs-up me-2"></i>Beğendiklerim ({{ $total_likes }})</a>
                              </div>
                      </div>

                      <!-- Content Area -->
                      <div class="col-lg-9 ps-0 ps-md-4">
                        <div id="myLikesList">
                            @include('user.partials.liked_topics', ['liked_topics' => $liked_topics])
                        </div>
                        <div id="loading" class="text-center my-4" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Yükleniyor...</span>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    
    .nav-pills .nav-link {
        color: #6c757d !important;
        border-radius: 10px;
        padding: 12px 20px;
        margin: 4px 0;
        text-align: left;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
    }

    .nav-pills .nav-link.active {
        background-color: #fff;
        color: #001B48 !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-label{
      font-weight: 600;
      font-family: monospace;
      font-size: 16px;
    }

    .dropdown-menu[data-bs-popper]{
      left: -55px;
      top: 55px;
    }

    .position-relative {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
      .content-wrapper {
          padding: 0px !important;
      }
    }

</style>

<style>
     .topic {
        border: 1px solid #dcdcdc !important;
        border-radius: 17px;
        padding: 10px 20px;
        }
       
        .topic h3 a{
            margin: 0;
            font-size: 17px;
            color: #333 !important;
            text-decoration: none;
        }

        .topic h3 a:hover{
            color: #424242 !important; 
            text-decoration: underline; 
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

        .avatar{
            display: block;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-top: -2px;
            margin-bottom: 2px;
            object-fit: cover;
        }
        .footer-info{
            float: left;
            vertical-align: middle;
            padding: 4px;
            padding-right: 10px;
        }
</style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let page = 1;
        let loading = false;
        let hasMore = {{ $total > 10 ? 'true' : 'false' }};

        $(window).on('scroll', function() {
            if (!loading && hasMore && $(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
                loading = true;
                page++;
                $('#loading').show();

                $.get('{{ route('my.likes.load') }}', { page: page }, function(data) {
                    $('#myLikesList').append(data.html);
                    hasMore = data.hasMore;
                    loading = false;
                    $('#loading').hide();
                });
            }
        });
    </script>

    <script>
    function getTopicUrl(type, topicId, action) {
        switch (type) {
            case 'city':
                return `/city/topic/${topicId}/${action}`;
            case 'university':
                return `/university/topic/${topicId}/${action}`;
            default:
                return `/general/topic/${topicId}/${action}`;
        }
    }

    $(document).on('click', '.like-btn', function () {
        const $this = $(this);
        const topicId = $(this).data('id');
        const type = $(this).data('type');
        const userId = '{{ auth()->id() }}';

        if (!userId) {
            toastr.error('Giriş yapmalısın.');
            return;
        }

        const likeCount = $(this).find('.like-count');
        const dislikeBtn = $(this).closest('.like-dislike').find('.dislike-btn');
        const dislikeCount = dislikeBtn.find('.dislike-count');

        $.ajax({
            url: getTopicUrl(type, topicId, 'like'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                likeCount.text(response.likes);
                dislikeCount.text(response.dislikes);

                if (response.removedFromLikes) {
                    $this.closest('.topic').slideUp(300, function () {
                        $(this).remove();

                        if ($('.topic').length === 0) {
                            $('.liked-topics-container').html('<h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>');
                        }
                    });
                }
            }
        });
    });

    $(document).on('click', '.dislike-btn', function () {
        const $this = $(this);
        const topicId = $(this).data('id');
        const type = $(this).data('type');
        const userId = '{{ auth()->id() }}';

        if (!userId) {
            toastr.error('Giriş yapmalısın.');
            return;
        }

        const dislikeCount = $(this).find('.dislike-count');
        const likeBtn = $(this).closest('.like-dislike').find('.like-btn');
        const likeCount = likeBtn.find('.like-count');

        $.ajax({
            url: getTopicUrl(type, topicId, 'dislike'),
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                likeCount.text(response.likes);
                dislikeCount.text(response.dislikes);

                if (response.removedFromLikes) {
                    $this.closest('.topic').slideUp(300, function () {
                        $(this).remove();

                        if ($('.topic').length === 0) {
                            $('.liked-topics-container').html('<h5 class="mb-4">Henüz hiçbir yorum beğenmediniz.</h5>');
                        }
                    });
                }
            }
        });
    });
</script>


    <script>
        $(document).ready(function () {
            $(".nav-link-profile").click(function (e) {
                e.preventDefault();
                $(".nav-link-profile").removeClass("active");
                $(this).addClass("active");
                
                $(".content-section").addClass("d-none");
                let target = $(this).data("target");
                $(target).removeClass("d-none");
            });
        });
    </script>
@endsection