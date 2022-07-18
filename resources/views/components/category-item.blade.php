<li class="nav-item">
    @if(str_ends_with(Request::url(),$item->slug))
    <a class="nav-link nav-pill-item me-2 rounded-4 my-1 my-sm-0 active text-light" href="{{route('category.show',['category'=>$item->slug])}}">{{$item->name}}</a>
    @else
    <a class="nav-link nav-pill-item me-2 rounded-4 text-dark my-1 my-sm-0" href="{{route('category.show',['category'=>$item->slug])}}">{{$item->name}}</a>
    @endif
</li>
