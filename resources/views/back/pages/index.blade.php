@extends('back.layouts.master')
@section('title','Tüm Sayfalar')
@section('css')
@endsection
@section('content')

    <div class="card shadow mb-12">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left"><b>{{$pages->count()}}</b> sayfa bulundu.</h6>

            <form method="get" action="{{route('admin.allDelete')}}">
                {{csrf_field()}}
                <button class="float-right btn btn-danger">Tümünü Sil</button>

            </form>

            <a href=""><button class="btn btn-warning float-right" style="margin-right: 20px;"><i class="fa fa-trash"></i>Silinen Sayfalar</button></a>

        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr >
                        <th>Sıralama</th>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody id="orders">
                    @foreach($pages as $page)
                    <tr id="order_{{$page->id}}">
                        <td class="text-center" style="font-size: 125px;"><i class="fa fa-arrows-alt-v handle " style="cursor: move; "></i></td>
                        <td><img src="{{asset($page->image)}}" alt="" style="width:250px;"></td>
                        <td><h6>{{$page->title}}</h6></td>

                        <td>{{$page->created_at}}</td>
                        <td>
                            <a class="float-center" href="{{route('admin.sayfalar.update',$page->id)}}"><button class="btn bnt-sml btn-primary " ><i class="fa fa-pen"></i></button></a>
                                                       <br><br>

                                <a href="{{route('admin.sayfalar.delete',$page->id)}}"  class="btn btn-danger"><i class="fa fa-trash"></i></a>


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
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.10.2/Sortable.min.js" integrity="sha256-8Ww0c1qKDMdHT2+3s3369kzSXcgIrvqzSwzjdZ5qHDs=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
        $('#orders').sortable({
            handle:'.handle',
            update:function () {
                var siralama = $('#orders').sortable('serialize');
                $.get("{{route('admin.sayfalar.orders')}}",{orders:siralama}, function(data,status) {
                        console.log(data);
                })
            }
        });
    </script>



@endsection