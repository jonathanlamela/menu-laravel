import { Inertia } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/inertia-react"
import React from "react";
import CategoryNavList from "../components/CategoryNavList";
import Layout from "../components/Layout";

export default () => {

    const { cart } = usePage().props;

    const cartRow = (row) => {

        const increaseQtyAction = () => {
            Inertia.post(route('cart.increase_qty'), {
                food_id: row.id
            })
        }

        const decreaseQtyAction = () => {
            Inertia.post(route('cart.decrease_qty'), {
                food_id: row.id
            })
        }

        const removeItemAction = () => {
            Inertia.post(route('cart.remove_item'), {
                food_id: row.id
            })
        }


        return <>
            <tr className="align-middle">
                <td className="">{row.name}</td>
                <td className="text-center">{row.quantity}</td>
                <td className="text-center">{row.price.toFixed(2)} €</td>
                <td className="text-center align-middle">
                    <div className="d-flex flex-row justify-content-center">
                        <button onClick={increaseQtyAction} className="btn btn-link"><i className="bi bi-bag-plus"></i>
                        </button>
                        <button onClick={decreaseQtyAction} className="btn btn-link"><i className="bi bi-bag-dash"></i>
                        </button>
                        <button onClick={removeItemAction} className="btn btn-link"><i className="bi bi-bag-x"></i>
                        </button>
                    </div>
                </td >
            </tr >
        </>
    }

    const cartContent = () => {
        return <>
            <div className="row g-0">
                <table className="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Cibo</th>
                            <th className="text-center" scope="col">Quantità</th>
                            <th className="text-center" scope="col">Prezzo</th>
                            <th className="text-center" scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {Object.values(cart.items).map((row) => cartRow(row))}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td className="text-center"><b>Totale</b></td>
                            <td className="text-center">{cart.subtotal.toFixed(2)} €</td>
                        </tr>
                    </tfoot>
                </table >
            </div >
            <div className="row g-0">
                <div className="col-lg-4">
                    <a className="btn btn-success" href="{{route('checkout.step1')}}">Vai alla cassa</a>
                </div>
            </div>
        </>
    }

    return <>
        <Layout title="Carrello" globalSearchEnabled={false} nav={<CategoryNavList></CategoryNavList>}>
            <div className="col-lg-12 p-4">
                <div className="col-lg-12 flex-grow-1">
                    {Object.keys(cart.items).length > 0 ? cartContent() : <div className="row g-0">
                        <p>Non ci sono elementi nel carrello</p>
                    </div>}
                </div>
            </div >
        </Layout >
    </>

}