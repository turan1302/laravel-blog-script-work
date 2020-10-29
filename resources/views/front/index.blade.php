@extends('front.layout.content')
@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">

            @include('front.layout.categoryWidget')

            <div class="col-lg-9 col-md-10 mx-auto">
                @include('front.layout.articleWidget')
            </div>
        </div>
    </div>
@endsection

<!-- Footer -->
