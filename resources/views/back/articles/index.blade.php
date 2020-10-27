@extends('back.layout.content')
@section('title','Makaleler')
@section('content')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Makaleler <small class="float-right" style="color: red">{{$articles->count()}} Makale Bulundu</small></h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Makale Yönetimini Bu Sayfadan Gerçekleştirebilirsiniz</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        DataTable Example
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
                                    <th>Durum</th>
                                    <th>Oluşturulma Tarihi</th>
                                    <th>İşlemler</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($articles as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td><img width="100" height="100" src="{{$item->image}}" alt="{{$item->title}}">
                                        </td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->categories->name}}</td>
                                        <td>{{$item->hit}}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" {{($item->status==1) ? 'checked':''}}>
                                                <span class="slider"></span>
                                            </label>
                                        </td>
                                        <td>{{$item->created_at}}</td>
                                        <td>
                                            <a href="" title="Görüntüle" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="" title="Düzenle" class="btn btn-info btn-sm"><i class="fa fa-pen-square"></i></a>
                                            <a href="" title="Sil" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
