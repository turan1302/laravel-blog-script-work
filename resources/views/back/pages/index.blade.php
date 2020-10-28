@extends('back.layout.content')
@section('title','Sayfalar')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kategoriler
                    <small class="float-right" style="color: red">{{$pages->count()}} Sayfa Bulundu |
                        {{--                        <a href="{{route('admin.categor.trashed')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>--}}
                    </small>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Sayfa Yönetimini Bu Sayfadan Gerçekleştirebilirsiniz</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Sayfalarınız
                        <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm float-right"><i
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
                                        <td><img src="{{$item->image}}" width="100" height="100" alt=""></td>
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
                                            <a target="_blank" href="{{route('front.page',$item->slug)}}" class="btn btn-warning btn-sm" title="{{$item->title}}"><i class="fa fa-eye"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm isActive"
                                                    data-url="{{route('admin.category.delete',$item->id)}}"
                                            ><i class="fa fa-trash"></i></button>
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
