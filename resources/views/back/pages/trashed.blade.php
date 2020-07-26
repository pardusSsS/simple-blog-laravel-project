@extends('back.layouts.master')
@section('title','Tüm Makaleler')

@section('content')

    <div class="card shadow mb-12">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left"><b>{{$articles->count()}}</b> makale bulundu.</h6>

            <form method="get" action="{{route('admin.allDelete')}}">
                {{csrf_field()}}
                <button class="float-right btn btn-danger">Tümünü Sil</button>

            </form>


        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Görüntülenme Sayısı</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Kurtar</th>
                        <th>Sil</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td><img src="{{asset($article->image)}}" alt="" style="width:250px;"></td>
                        <td><h6>{{$article->title}}</h6></td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at}}</td>
                        <td><a title="Kurtar" href="{{route('admin.kurtar',$article->id)}}"><button class="btn btn-primary " ><i class="fa fa-trash-restore"></i></button></a></td>
                        <td title="Sil"><a href="{{route('admin.hardDelete',$article->id)}}" title="Sil" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {


                 id = $(this).attr('article-id');
                statu = $(this).prop('checked');
                $.get("{{route('admin.switch')}}", {id:id,statu:statu} ,function(data, status){
                    console.log(data);
                });
            })




        })
    </script>
@endsection