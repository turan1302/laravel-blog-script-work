@forelse($articles as $article)
    <div class="post-preview">
        <a href="{{route('front.single',[$article->categories->slug,$article->slug])}}">
            <h2 class="post-title">
                {{$article->title}}
            </h2>
            @if(file_exists($article->image))
                <img width="600" height="300" src="{{asset($article->image)}}" alt="{{$article->title}}">
            @else
                <img src="{{asset('articleImages')}}/resim-yok.png" width="600" height="300" alt="">
            @endif
            <h3 class="post-subtitle">
                {{strip_tags(\Illuminate\Support\Str::words($article->text."..",20))}}
            </h3>
        </a>
        <p class="post-meta">Kategori:
            <a href="#">{{$article->categories->name}}</a>
            <span class="float-right">Tarih: {{$article->created_at}}</span></p>
    </div>
    @if(!$loop->last)
        <hr>
    @endif

@empty
    <div class="alert alert-danger text-center">
        Hiçbir Kayıt Bulunamadı
    </div>
@endforelse
<!-- Pager -->
<div class="clearfix float-right">
    {{$articles->links()}}
    {{--                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>--}}
</div>
