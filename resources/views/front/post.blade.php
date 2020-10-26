@extends('front.layout.content')
@section('title',$blog->title)
@section('bg',$blog->image)
@section('content')
    <!-- POST -->
    <article>
        <div class="container">
            <div class="row">

                @include('front.layout.categoryWidget')

                <div class="col-md-9 mx-auto">
                   {{$blog->text}}
                    <p></p>
                    <span class="text-red align-content-end">Okunma Sayısı: <b>{{$blog->hit}}</b></span>
                </div>

            </div>
        </div>
    </article>

@endsection

<!-- Footer -->
