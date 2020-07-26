@extends('front.layouts.master')


@section('content')
    <!-- Post Content -->


        @section('title',$articel->title)
            @section('bg',$articel->image)
                <div class="col-md-9 mx-auto" >
                        {!!$articel->content !!}

                </div>


    @include('front.widgets.categoriesWidget')
<span class="text-red">Okunma Sayısı: <b>{{$articel->hit}}</b></span>


    @endsection


