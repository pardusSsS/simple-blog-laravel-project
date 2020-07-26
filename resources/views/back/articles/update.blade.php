@extends('back.layouts.master')
@section('title',$article->title ." Kategorisini Düzenle");

@section('content')
    <form action="{{route('admin.makaleler.update',$article->id)}}" method="post" enctype="multipart/form-data">

        {{ method_field('PUT') }}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Makele Oluştur
            </div>

            <div class="form-group">
                <img style="width: 200px;" src="{{asset($article->image)}}" alt="">
                <input type="file" name="image" >
            </div>

            <div class="card-body">
                <label for="">Makale Başlığı</label>
                <input type="text" class="form-control" name="title" value="{{$article->title}}">
            </div>

            <div  class="card-body">
                <label for="">Makale Kategorisi</label>

                <select name="category" id="" class="form-control" ">
                    @foreach($categories as $category)
                        <option @if($article->category_id === $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="card-body">
                <label for="">Makelenin Gösterilme Durumu</label>
                <select name="status" class="form-control">
                    @if($article->status == 1)
                        <option value="1">1</option>
                        <option value="0">0</option>

                    @else
                        <option value="0">0</option>
                        <option value="1">1</option>
                        @endif

                </select>

            </div>

            <div class="card-body">
                <label for="">Makale</label>
                <textarea name="contentt"  cols="30" rows="10" class="form-control">{{$article->content}}</textarea>
            </div>

        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary float-right"  >Güncelle</button>

    </form>

@section('script')

@endsection
@endsection