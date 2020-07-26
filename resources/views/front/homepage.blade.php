
@extends('front.layouts.master')

@section('title','Blog Sitesi')
<!-- Main Content -->
@section('content')



        <div class="col-md-9 mx-auto">

                @include('front.widgets.ArticleList')
            <!-- Pager -->


        </div>
        <!--Categories-->
        @include('front.widgets.categoriesWidget')
@endsection
