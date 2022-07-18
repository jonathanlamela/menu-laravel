<tr class="align-middle">
    <td class="">{{$item["name"]}}</td>
    <td class="text-center">{{$item["quantity"]}}</td>
    <td class="text-center">{{number_format($item["price"],2)}} €</td>
    <td class="text-center align-middle">
        <div class="d-flex flex-row justify-content-center">
            <form method="post" class="d-flex m-0" action="{{route('cart.increase_qty')}}">
                @csrf
                <input type="hidden" name="food_id" value="{{$item["id"]}}" />
                <button type="submit" class="btn btn-link"><i class="bi bi-bag-plus"></i>
                    </i>
                </button>
            </form>
            <form method="post" class="d-flex m-0" action="{{route('cart.decrease_qty')}}">
                @csrf
                <input type="hidden" name="food_id" value="{{$item["id"]}}" />
                <button type="submit" class="btn btn-link"><i class="bi bi-bag-dash"></i>
                    </i>
                </button>
            </form>
            <form method="post" class="d-flex m-0" action="{{route('cart.remove_item')}}">
                @csrf
                <input type="hidden" name="food_id" value="{{$item["id"]}}" />
                <button type="submit" class="btn btn-link"><i class="bi bi-bag-x"></i>
                    </i>
                </button>
            </form>
        </div>
    </td>
</tr>
