@extends('admin.master')

@section('title', 'Blog Kategorileri | CampusConenct')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .sidebar {
            background: white !important;
            border: 2px solid #004D49;
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
            color: #004D49;
        }

        .sidebar .nav-link.active {
            background-color: #004D49;
            color: white;
            border-radius: 10px;
        }

        .card {
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 1.5rem;
        }

        .list-group-item {
            font-size: 1.1rem;
            border: 1px solid #ddd;
        }

        .container-fluid {
            padding-top: 20px;
        }

        .ck-editor__editable {
            min-height: 300px;
        }

        #applicationForm{
            margin-top: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main content -->
            <main class="col-md-9 col-lg-10 px-4">
                <h1 class="h2">Blog Kategorisi Ekle</h1>

                <form action="{{ route('admin.blog.category.store') }}" method="POST" id="blogCategoryCreateForm">
                    @csrf
                    <div class="row mt-5 mb-3">
                        <div class="mb-3 col-md-6">
                            <label for="cover_image" class="form-label">Kategori Adı</label>
                            <input type="text" class="form-control" style="border: 1px solid gray" id="category_name" name="category_name">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="mb-3 col-md-6">
                            <label for="cover_image" class="form-label">Kategori Slug</label>
                            <input type="text" class="form-control" style="border: 1px solid gray" id="category_slug" name="category_slug">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Başvuruyu Kaydet</button>
                </form>

            </main>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif
    </script>

<script>
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/ç/g, 'c')
            .replace(/ğ/g, 'g')
            .replace(/ı/g, 'i')
            .replace(/ö/g, 'o')
            .replace(/ş/g, 's')
            .replace(/ü/g, 'u')
            .replace(/\s+/g, '-')           // boşlukları tireye çevir
            .replace(/[^\w\-]+/g, '')       // alfasayısal olmayanları sil
            .replace(/\-\-+/g, '-')         // ardışık tireleri teke indir
            .replace(/^-+/, '')             // baştaki tireyi sil
            .replace(/-+$/, '');            // sondaki tireyi sil
    }

    document.getElementById('category_name').addEventListener('input', function () {
        const name = this.value;
        document.getElementById('category_slug').value = slugify(name);
    });
</script>

    
    
   
@endsection
