<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @forelse($categories as $category)
                <a href="#" class="list-group-item">{{$category->name}} <span
                        class="badge badge-success float-right">{{$category->articles->count()}}</span></a>
            @empty
                <a href="#" class="list-group-item">Kayıt Bulunamadı</a>
            @endforelse
        </div>
    </div>
</div>
