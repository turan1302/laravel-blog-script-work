@extends('front.layout.content')
@section('title',$page->title)
@section('bg',$page->image)
@section('content')
    <!-- POST -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
               {!! $page->content !!}
            </div>
        </div>
    </div>

@endsection

<!-- Footer -->
