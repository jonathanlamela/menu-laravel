import { useForm } from "@inertiajs/inertia-react";
import React from "react";


export default ({ item }) => {

    const { post, data } = useForm({
        food_id: item.id,
        food_name: item.name,
        food_price: item.price
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('cart.add_item'));
    }

    return <>

        <div className="row g-0 my-2">
            <div className="col-lg-8">
                <div className="g-0 row">
                    <div className="col-lg-12">
                        {item.name}
                    </div>
                    {item.ingredients ? <div className="col-lg-12 ingredients">
                        {item.ingredients}
                    </div> : <></>}
                </div>
            </div>
            <div className="col-lg-4 d-flex justify-content-end align-items-center">
                {item.price.toFixed(2)} €
                <form className="m-0" onSubmit={handleSubmit}>
                    <input type="hidden" name="food_id" value={data.food_id} />
                    <input type="hidden" name="food_name" value={data.food_name} />
                    <input type="hidden" name="food_price" value={data.food_price} />
                    <button type="submit" className="btn btn-info ms-3"><i className="bi bi-cart-plus"></i></button>
                </form>
            </div>
        </div>
    </>
}