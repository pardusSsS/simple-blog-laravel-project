@extends('back.layouts.master')
@section('title',$page->title ." Kategorisini Düzenle");

@section('content')
    <form action="{{route('admin.sayfalar.updatePost',$page->id)}}" method="post" enctype="multipart/form-data">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Sayfa Oluştur
            </div>

            <div class="form-group">
                <img style="width: 200px;" src="{{asset($page->image)}}" alt="">
                <input type="file" name="image" >
            </div>

            <div class="card-body">
                <label for="">Sayfa Başlığı</label>
                <input type="text" class="form-control" name="title" value="{{$page->title}}">
            </div>

            <div class="card-body">
                <label for="">Sayfa İçeriği</label>
                <textarea name="contentt"  cols="30" rows="10" class="form-control">{{$page->content}}</textarea>
            </div>

        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary float-right"  >Güncelle</button>

    </form>

@section('script')

@endsection
@endsection