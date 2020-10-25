@extends('front.layout.content')
@section('title','Anasayfa')
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">

            @include('front.layout.categoryWidget')

            <div class="col-lg-9 col-md-10 mx-auto">
                @foreach($articles as $article)
                    <div class="post-preview">
                        <a href="{{route('front.single',[$article->categories->slug,$article->slug])}}">
                            <h2 class="post-title">
                                {{$article->title}}
                            </h2>
                            <h3 class="post-subtitle">
                                {{\Illuminate\Support\Str::words($article->text."..",20)}}
                            </h3>
                        </a>
                        <p class="post-meta">Kategori:
                            <a href="#">{{$article->categories->name}}</a>
                            <span class="float-right">Tarih: {{$article->created_at}}</span></p>
                    </div>
                    @if(!$loop->last)
                        <hr>
                    @endif
            @endforeach
            <!-- Pager -->
                <div class="clearfix float-right">
                    {{$articles->links()}}
                    {{--                    <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Footer -->
