@extends('back.layout.content')
@section('title','Site Ayarları')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Site Ayarları </h1>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Site Bilgileri</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.settings.update',$config->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Site Başlığı</label>
                                        <input type="text" name="title" class="form-control"
                                               value="{{old('title') ?? $config->title}}">
                                        @error('title')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Site Aktiflik Durumu</label>
                                        <select name="active" class="form-control" id="">
                                            <option
                                                value="1" {{ (old('active')=="1") ? 'selected':(($config->active=="1") ? 'selected':'') }}>
                                                Aktif
                                            </option>
                                            <option
                                                value="0" {{ (old('active')=="0") ? 'selected':(($config->active=="0") ? 'selected':'') }}>
                                                Pasif
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Site Logo</label>
                                        <input type="file" name="logo" class="form-control">
                                        @error('logo')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Site Favicon</label>
                                        <input type="file" name="favicon" class="form-control">
                                        @error('favicon')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Facebook</label>
                                        <input type="text" name="facebook" class="form-control"
                                               value="{{old('facebook') ?? $config->facebook}}">
                                        @error('facebook')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Twitter</label>
                                        <input type="text" name="twitter" class="form-control"
                                               value="{{old('twitter') ?? $config->twitter}}">
                                        @error('twitter')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Github</label>
                                        <input type="text" name="github" class="form-control"
                                               value="{{old('github') ?? $config->github}}">
                                        @error('github')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Linkedin</label>
                                        <input type="text" name="linkedin" class="form-control"
                                               value="{{old('linkedin') ?? $config->linkedin}}">
                                        @error('linkedin')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Youtube</label>
                                        <input type="text" name="youtube" class="form-control"
                                               value="{{old('youtube') ?? $config->youtube}}">
                                        @error('youtube')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Instagram</label>
                                        <input type="text" name="instagram" class="form-control"
                                               value="{{old('instagram') ?? $config->instagram}}">
                                        @error('instagram')
                                        <small style="color: red;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Güncelle
                            </button>
                            <a href="{{route('admin.index')}}" class="btn btn-danger btn-sm"><i
                                    class="fa fa-times"></i> Vazgeç</a>
                        </form>
                    </div>
                </div>
            </div>
        </main>



@endsection
