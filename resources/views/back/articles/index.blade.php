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

            <a href="{{route('admin.trashed.article')}}"><button class="btn btn-warning float-right" style="margin-right: 20px;"><i class="fa fa-trash"></i>Silinen Makaleler</button></a>

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
                        <th>Durum</th>
                        <th>İşlemler</th>
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
                        <td><input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasiff" data-onstyle="primary" data-offstyle="danger" @if($article->status=='1') checked @endif  data-toggle="toggle"></td>
                        <td>
                            <a class="float-center" href="{{route('admin.makaleler.edit',$article->id)}}"><button class="btn bnt-sml btn-primary " ><i class="fa fa-pen"></i></button></a>
                                                       <br><br>
                            <form class="float-center" method="post" action="{{route('admin.makaleler.destroy', $article->id )}}" >
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <button type="submit"  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>

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