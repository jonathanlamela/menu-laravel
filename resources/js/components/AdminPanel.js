import { Link } from "@inertiajs/inertia-react"
import React from "react"


export default () => {
    return <>
        <div className="row g-0 mt-3">
            <div className='col-lg-12 d-flex flex-column'>
                <h4>Amministrazione</h4>
                <Link className="text-decoration-none" href={route('admin.category.list')}>Gestisci categorie</Link>
                <Link className="text-decoration-none" href={route('admin.food.list')}>Gestisci cibi</Link>
                <Link className="text-decoration-none" href={route('admin.order.list')}>Gestisci ordini</Link>
            </div>

        </div>
    </>
}