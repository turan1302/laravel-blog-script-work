<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @forelse($categories as $category)
                <li class="list-group-item @if(Request::segment(2)==$category->slug) active @endif">
                    <a href="{{route('front.category',$category->slug)}}" class="list-group-item">{{$category->name}} <span
                            class="badge badge-success float-right">{{$category->articles->count()}}</span></a>
                </li>
            @empty
                <a href="#" class="list-group-item">Kategori Bulunamadı</a>
            @endforelse
        </div>
    </div>
</div>
