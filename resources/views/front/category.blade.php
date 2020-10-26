@extends('front.layout.content')
@section('title',$category." Kategorisi")
@section('category',$category.' Kategorisi | '.count($articles)." Yazı Bulundu")
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">

            @include('front.layout.categoryWidget')

            <div class="col-lg-9 col-md-10 mx-auto">

                @if(!count($articles)>0)
                    <div class="col-md-12 alert alert-danger text-center">
                        Bu Kategoriye Ait Yazı Bulunamadı
                    </div>
                @else
                    @include('front.layout.articleWidget')

                @endif

            </div>
        </div>
    </div>
@endsection

<!-- Footer -->
