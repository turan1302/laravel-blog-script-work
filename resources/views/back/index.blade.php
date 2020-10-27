@extends('back.layout.content')
@section('title','Panel')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Blog Sitesi Admin Paneli</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Hoşgeldiniz | {{auth()->user()->name}}</li>
            </ol>
        </div>
    </main>

@endsection
