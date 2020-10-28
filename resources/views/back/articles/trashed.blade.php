@extends('back.layout.content')
@section('title','Silinen Makaleler')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Silinen Makaleler
                    <small class="float-right" style="color: red">{{$articles->count()}} Makale Bulundu |
                        <a href="{{route('admin.article.index')}}" class="btn btn-primary btn-sm"> Aktif Makaleler</a>
                    </small>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Silinen Makaleleri Bu Kısımdan Görebilirsiniz</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Silinen Makaleleriniz
                        <a href="{{route('admin.article.create')}}" class="btn btn-success btn-sm float-right"><i
                                class="fa fa-plus"></i> Yeni Ekle</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Makale ID</th>
                                    <th>Makale Fotoğraf</th>
                                    <th>Makale Başlığı</th>
                                    <th>Kategori</th>
                                    <th>Görüntüleme Sayısı</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($articles as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>
                                            @if(file_exists($item->image))
                                                <img src="{{asset($item->image)}}" width="100" height="100"
                                                     alt="{{$item->title}}">
                                            @else
                                                <img src="{{asset('articleImages')}}/resim-yok.png" width="100"
                                                     height="100" alt="">
                                            @endif
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->categories->name}}</td>
                                        <td>{{$item->hit}}</td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <a href="{{route('admin.article.recover',$item->id)}}" title="Geri Al" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-recycle"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm isHardDelete" data-url="{{route('admin.article.hardDelete',$item->id)}}"><i class="fa fa-trash"></i></button>
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
