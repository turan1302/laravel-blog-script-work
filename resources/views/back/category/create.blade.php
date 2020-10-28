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
                        <form action="{{route('admin.category.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Kategori Başlığı</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                        @error('name')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ekle
                            </button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i> Vazgeç</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>

@endsection
