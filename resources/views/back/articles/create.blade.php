@extends('back.layout.content')
@section('title','Makale Ekle')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Yeni Makale Ekle</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Makale Bilgileri</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Makale Başlığı</label>
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                        @error('title')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Makale Kategori</label>
                                        <select name="category_id" class="form-control" id="">
                                            <option value="">--Seçim Yapınız--</option>
                                            @forelse($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{(old('category_id')==$category->id) ? 'selected':''}}>{{$category->name}}</option>
                                            @empty
                                                <option value="">Kategori Yok</option>
                                            @endforelse
                                        </select>
                                        @error('category_id')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Makale Fotoğrafı</label>
                                        <input type="file" name="image" class="form-control">
                                        @error('image')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Makale İçeriği</label>
                                        <textarea name="text" id="summernote" cols="30" rows="10"
                                                  class="form-control"></textarea>
                                        @error('text')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ekle
                            </button>
                            <a href="{{route('admin.article.index')}}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i> Vazgeç</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>

@endsection
