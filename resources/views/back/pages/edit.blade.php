@extends('back.layout.content')
@section('title','Sayfa Güncelle')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Sayfa Güncelle</h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sayfa Bilgileri</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.page.update',$page->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Sayfa Başlığı</label>
                                        <input type="text" name="title" class="form-control" value="{{old('title') ?? $page->title}}">
                                        @error('title')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <p></p>
                                        <label for="">Aktif Resim</label>
                                        @if(\Illuminate\Support\Facades\File::exists($page->image))
                                            <img src="{{asset($page->image)}}" width="250" height="250" alt="{{$page->title}}">
                                        @else
                                            <img src="{{asset('pageImages')}}/resim-yok.png" width="250" height="250" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Resim</label>
                                        <input type="file" name="image" class="form-control" value="{{old('title')}}">
                                        @error('image')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Sayfa İçeriği</label>
                                        <textarea name="content" id="summernote" cols="30" rows="10"
                                                  class="form-control">{{old('content') ?? $page->content}}</textarea>
                                        @error('content')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Güncelle
                            </button>
                            <a href="{{route('admin.page.index')}}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i> Vazgeç</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>

@endsection
