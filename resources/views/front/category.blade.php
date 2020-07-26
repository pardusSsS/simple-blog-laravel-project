@extends('front.layouts.master')
@section('title',$category->name.'Kategorisi | '.count($articles).' yazı bulundu')

@section('content')

<div class="col-md-9 mx-auto">

        @include('front.widgets.ArticleList')

    </div>
    @include('front.widgets.categoriesWidget')

    @endsection