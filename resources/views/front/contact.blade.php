@extends('front.layouts.master')
@section('title','İletişim')
@section('bg','https://www.mypierrecardin.com/skins/shared/images/1132-contact.png')
@section('content')
<!-- Main Content -->

        <div class="col-lg-8 col-md-10 mx-auto">

            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}<a href="#" class="close" data-dismiss ="alert" aria-label="close">&times;</a>
                </div>
                @endif
            @if($errors->any())
                <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
            </ul>
                </div>
                @endif
            <form method="post" action="{{route('iletisim.post')}}" >
                <div class="control-group">
                    <div class="form-group  controls">
                        <label>Adınız</label>
                        <input type="text" class="form-control" placeholder="Adınız" value="{{old('name')}}" name="name" required >
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group  controls">
                        <label>Email Adresiniz</label>
                        <input type="email" class="form-control" placeholder="Email Adresiniz" value="{{old('email')}}" name="email" required >
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group col-xs-12  controls">
                        <label>Konu</label>
                        <select class="form-control" name="topic" >
                            <option @if(old('topic')=="Bilgi") selected @endif >Bilgi</option>
                            <option @if(old('topic')=="Destek") selected @endif >Destek</option>
                            <option @if(old('topic')=="Genel") selected @endif>Genel</option >
                        </select>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="form-group  controls">
                        <label>Mesajınız</label>
                        <textarea rows="5" class="form-control" placeholder="Mesajınız" name="message" >{{old('message ')}}</textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div id="success"></div>
                {{csrf_field()}}

                <a href=""><button type="submit" class="btn btn-primary" >Gönder</button></a>
            </form>
        </div>


@endsection
<!-- Footer -->
