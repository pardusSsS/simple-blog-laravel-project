@if(count($articles)>0 )
@foreach($articles as $articel)
    <div class="post-preview" >
        <a href="{{route('single',[$articel->getCategory->slug,$articel->slug])}}">
            <h2 class="post-title">
                {!!$articel->title!!}
            </h2>
            <img src="{{$articel->image}}" alt=""/>
            <h3 class="post-subtitle">
                {!!str_limit($articel->content,70)!!}
            </h3>
        </a>
        <p class="post-meta">
            <a href="#">{{$articel->getCategory->name}}</a> <span class="float-right">{{$articel->created_at->diffForHumans()}}</span></p>
        <div class="clearfix">
        </div>
    </div>

@endforeach
{{$articles->links()}}
@else
    <div class="alert alert-danger">
        <h1>Bu kategoriye ait yazı bulunamadı</h1>
    </div>
@endif

