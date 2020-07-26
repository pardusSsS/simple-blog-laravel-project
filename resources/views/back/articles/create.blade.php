@extends('back.layouts.master')
@section('title','Makale Oluştur')

@section('content')
    <form action="{{route('admin.makaleler.store')}}" method="post" enctype="multipart/form-data">

@if($errors->any())

    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    </div>

    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            Makele Oluştur
        </div>

        <div class="form-group">
            <input type="file" name="image"     >
        </div>

        <div class="card-body">
            <label for="">Makale Başlığı</label>
            <input type="text" class="form-control" name="title">
        </div>

        <div  class="card-body">
            <label for="">Makale Kategorisi</label>

            <select name="category" id="" class="form-control">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="card-body">
            <label for="">Makelenin Gösterilme Durumu</label>
            <select name="status" class="form-control">
                <option value="0">0</option>
                <option value="1">1</option>
            </select>

        </div>

        <div class="card-body">
            <label for="">Makale</label>
            <textarea name="contentt"  cols="30" rows="10" class="form-control"></textarea>
        </div>

    </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary float-right"  >Ekle</button>

    </form>

@section('script')

    @endsection
@endsection