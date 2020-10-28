@extends('back.layout.content')
@section('title','Sayfalar')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Sayfalar
                    <small class="float-right" style="color: red">{{$pages->count()}} Sayfa Bulundu | <a
                            href="{{route('admin.page.index')}}" class="btn btn-primary btn-sm"> Aktif Sayfalar</a>
                    </small>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Sayfa Yönetimini Bu Sayfadan Gerçekleştirebilirsiniz</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Sayfalarınız
                        <a href="{{route('admin.page.create')}}" class="btn btn-success btn-sm float-right"><i
                                class="fa fa-plus"></i> Yeni Ekle</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-bars"></i></th>
                                    <th>Sayfa ID</th>
                                    <th>Sayfa Resmi</th>
                                    <th>Sayfa Başlığı</th>
                                    <th>Slug</th>
                                    <th>Durum</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($pages as $item)
                                    <tr>
                                        <td class="fa fa-bars"></td>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            @if(\Illuminate\Support\Facades\File::exists($item->image))
                                                <img src="{{asset($item->image)}}" width="100" height="100"
                                                     alt="{{$item->title}}">
                                            @else
                                                <img src="{{asset('pageImages')}}/resim-yok.png" width="100"
                                                     height="100" alt="">
                                            @endif
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->slug}}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="isActive"
                                                       data-url="{{route('admin.page.switch',$item->id)}}" {{($item->status==1) ? 'checked':''}}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.page.recover',$item->id)}}" title="Geri Al" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-recycle"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm isPageHardDelete" data-url="{{route('admin.page.hardDelete',$item->id)}}"><i class="fa fa-trash"></i></button>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">Veri Yok</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>



@endsection
