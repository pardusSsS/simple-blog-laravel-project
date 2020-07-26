@extends('back.layouts.master')
@section('title','Tüm Makaleler')

@section('content')



    <div class="flash-message">
        @if(Session::has('msg'))
            <p class="alert alert-success">
                {{Session::get('msg')}}<a href="#" class="close" data-dismiss ="alert" aria-label="close">&times;</a>
            </p>
        @endif
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mevcut Kategoriler</h6>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Kategori İd</th>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>>

                                <th style="text-align: center;">İşlemler</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->articelCount()}}</td>
                                    <td><a  category-id="{{$category->id}}" title="Düzenle" href="" class="btn btn-primary float-left edit-click" style="margin-left: 50px;"><i class="fa fa-pencil-alt"></i></a>
                                        <a type="submit" category-id="{{$category->id}}" article-count="{{$category->articelCount()}}" category-name="{{$category->name}}"   class="btn btn-primary delete-click"><i class="fa fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <form method="post" action="{{route('admin.categories.store')}}" class="col-md-5">
        {{csrf_field()}}

        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#category" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="category">
                <h6 class="m-0 font-weight-bold text-primary"> Kategori Oluştur </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse" id="category" style="">
                <div class="card-body">
                    <label for="">Kategori Adı</label>
                    <input class="form-control" type="text" name="name">
                </div>
               <button id="add" type="submit" class="btn btn-primary float-right" style="margin-bottom: 15px; margin-right: 20px;">Ekle</button>

            </div>
        </div>
        </form>
    </div>



    <!---------------- DELETE MODAL----------------------->

    <div class="modal fade" id="deletemodal"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kategoriyi Sil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div id="articleAlert">

                    </div>

                    <div class="modal-footer">
                        <form method="post" action="{{route('admin.category.deleteCategory')}}">
                            {{csrf_field()}}
                        <button id="deleteButton" type="submit" class="btn btn-primary">Sil</button>
                        <input type="hidden" name="id" id="deleteid">
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal Et</button>
                    </div>

                </div>

            </div>
        </div>

<div class="clearfix"></div>


        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="editmodal" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('admin.category.updatee')}}">

                            <div class="form-group">
                                <label for="">Kategori Adı</label>
                                <input id="kategori" type="text" class="form-control" name="category">
                                <input type="hidden" name="id" id="category-id">
                            </div>

                            <div class="form-group">
                                <label for="">Kategori Slug</label>
                                <input id="slug" type="text" class="form-control" name="slug">
                            </div>



                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal Et</button>
                                <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                            </div>
                            {{csrf_field()}}

                        </form>
                    </div>
                </div>
            </div>



@endsection

@section('js')
    <script>
        $(function(){
           $('.edit-click').click(function(e){
               e.preventDefault();
              id=$(this).attr('category-id');
              $.ajax({
                  type:'GET',
                  url:'{{route('admin.category.getdata')}}',
                  data:{id:id},
                  success:function (data) {
                        console.log(data);
                      $('#kategori').val(data.name);
                      $('#slug').val(data.slug);
                      $('#category-id').val(data.id);
                      $('#editmodal').modal();
                  }
              })
           });
           //-----------------------------------------------------------------------
           //delete

            $('.delete-click').click(function (e) {
                $('#deleteButton').show();

                id=$(this).attr('category-id');
              $('#deleteid').val(id);


                alert(id);
                count=$(this).attr('article-count');
                name=$(this).attr('category-name');
                if(id=='1'){
                    $('#articleAlert').html(name+' kategorisi sabit bir kategoridir. Silinen diğer kategorilee ait makaleler bu kategoriye aktarılmaktadır.');
                      $('#deleteButton').hide();
                    $('#deletemodal').modal();
                    return;
                }



                $('#articleAlert').html("");
                $('#deletemodal').modal();
                if(count>0){
                    $('#articleAlert').html('Bu kategoriye ait '+count+' adet makale bulunmaktadır. Silmek istediğinize emin misiniz?');

                    $('#deleteButton').show();

                }

                    e.preventDefault();
            });


        });
    </script>
@endsection

