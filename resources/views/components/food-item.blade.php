<div class="row g-0 my-2">
    <div class="col-lg-8">
        <div class="g-0 row">
            <div class="col-lg-12">
                {{$item->name}}
            </div>
            @if($item->ingredients!=null)
            <x-food-ingredients :ingredients="$item->ingredients"></x-food-ingredients>
            @endif
        </div>
    </div>
    <div class="col-lg-4 d-flex justify-content-end align-items-center">
        {{number_format($item->price,2)}} €
        <form method="post" class="m-0" action="{{route('cart.add_item')}}">
            @csrf
            <input type="hidden" name="food_id" value="{{$item->id}}" />
            <input type="hidden" name="food_name" value="{{$item->name}}" />
            <input type="hidden" name="food_price" value="{{$item->price}}" />
            <button type="submit" class="btn btn-info ms-3"><i class="bi bi-cart-plus"></i></button>
        </form>
    </div>
</div>