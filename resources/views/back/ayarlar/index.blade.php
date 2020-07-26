@extends('back.layouts.master')
@section('title','Ayarlar')
@section('css')
@endsection
@section('content')

    <div class="card shadow  mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary ">@yield('title')</h6>
            <div class="card-body">
                <form method="post" action="{{route('admin.config.update')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >Site Başlığı</label>
                            <input type="text" name="title" class="form-control" value="{{$config->title}}">
                        </div>
                    </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Site Aktiflik Durumu</label>
                               <select class="form-control" name="active">
                                   <option value="1" @if($config->active=='1') selected @endif>Açık</option>
                                   <option value="0" @if($config->active=='0') selected @endif>Kapalı</option>
                               </select>
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Site Logo</label>
                               <input type="file" name="logo" class="form-control" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Site Favicon</label>
                               <input type="file" name="favicon" class="form-control" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >facebook</label>
                               <input type="text" name="facebook" class="form-control" value="{{$config->facebook}}" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Twitter</label>
                               <input type="text" name="twitter" class="form-control" value="{{$config->twitter}}" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >GitHub</label>
                               <input type="text" name="github" class="form-control" value="{{$config->github}}" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Linkedin</label>
                               <input type="text" name="linkedin" class="form-control" value="{{$config->linkedin}}" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >YouTube</label>
                               <input type="text" name="youtube" class="form-control" value="{{$config->youtube}}" >
                           </div>
                       </div>

                       <div class="col-md-6">
                           <div class="form-group">
                               <label >Instagram</label>
                               <input type="text" name="instagram" class="form-control" value="{{$config->instagram}}" >
                           </div>
                       </div>

                   </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>




@endsection