@isset($categories)
<div class="col-md-3 float-right">
    <div class="card">
        <div class="card-header">Kategoriler</div>
        <ul class="list-group " >
            @foreach($categories as $category)
                <li class="list-group-item @if(Request::segment(2)==$category->slug)active @endif"><a href="{{route('category',$category->slug)}}">{{$category->name}}</a><span class="badge badge-primary badge-pill float-right">{{$category->articelCount()}}</span></li>
            @endforeach
        </ul>
    </div>
</div>
    @endif