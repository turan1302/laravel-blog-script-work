@extends('back.layout.content')
@section('title','Kategoriler')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Kategoriler
                    <small class="float-right" style="color: red">{{$categories->count()}} Kategori Bulundu |
                        {{--                        <a href="{{route('admin.categor.trashed')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>--}}
                    </small>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Kategori Yönetimini Bu Sayfadan Gerçekleştirebilirsiniz</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Kategorileriniz
                        <a href="{{route('admin.category.create')}}" class="btn btn-success btn-sm float-right"><i
                                class="fa fa-plus"></i> Yeni Ekle</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Kategori ID</th>
                                    <th>Kategori Başlığı</th>
                                    <th>Slug</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categories as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->slug}}</td>
                                        <td>{{$item->articles->count()}}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="isActive" data-url="{{route('admin.category.switch',$item->id)}}" {{($item->status==1) ? 'checked':''}}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>

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
