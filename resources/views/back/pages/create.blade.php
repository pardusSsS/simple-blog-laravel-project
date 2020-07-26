@extends('back.layouts.master')
@section('title','Sayfa Oluştur')

@section('content')
    <form action="{{route('admin.sayfalar.store')}}" method="post" enctype="multipart/form-data">

@if($errors->any())

    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>

    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Sayfa Oluştur
        </div>

        <div class="form-group">
            <input type="file" name="image"     >
        </div>

        <div class="card-body">
            <label for="">Sayfa Başlığı</label>
            <input type="text" class="form-control" name="title">
        </div>

        



        <div class="card-body">
            <label for="">Sayfa İçeriği</label>
            <textarea name="contentt"  cols="30" rows="10" class="form-control"></textarea>
        </div>

    </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary float-right"  >Ekle</button>

    </form>

@section('script')

    @endsection
@endsection