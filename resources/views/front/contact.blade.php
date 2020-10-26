@extends('front.layout.content')
@section('title','İletişim')
@section('bg',asset('front/img/contact-bg.jpg'))
@section('content')
    <!-- POST -->

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <p>Bizimle İletişime Geçebilirsiniz.</p>
                @if(session()->has('contact'))
                    <div class="alert alert-success">
                        {{session('contact')}}
                    </div>
                @endif
                <form name="sentMessage" method="post" action="{{route('front.contactPost')}}" id="contactForm" novalidate>
                    @csrf
                    <div class="control-group">
                        <div class="form-group controls">
                            <label>Ad Soyad</label>
                            <input type="text" class="form-control" placeholder="Ad Soyadınız" name="name" value="{{old('name') ?? ''}}" id="name" data-validation-required-message="Please enter your name.">
                            @error('name')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group controls">
                            <label>E-Mail Adresiniz</label>
                            <input type="email" class="form-control" placeholder="Email Adresiniz" name="email" value="{{old('email') ?? ''}}" id="email" required data-validation-required-message="Please enter your email address.">
                            @error('email')
                                <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group col-xs-12 controls">
                            <label>Konu</label>
                            <select name="topic" class="form-control">
                                <option {{(old('topic')=="Bilgi") ? 'selected':''}} value="Bilgi">Bilgi</option>
                                <option {{(old('topic')=="Destek") ? 'selected':''}} value="Destek">Destek</option>
                                <option {{(old('topic')=="Genel") ? 'selected':''}} value="Genel">Genel</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group controls">
                            <label>Mesajınız</label>
                            <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" id="message" required data-validation-required-message="Please enter a message.">{{old('message')}}</textarea>
                            @error('message')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
                </form>
            </div>
        </div>
    </div>

@endsection

<!-- Footer -->
