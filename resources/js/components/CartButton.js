import React from "react"
import { Link, usePage } from '@inertiajs/inertia-react'

export default function CartButton() {
    const { cart } = usePage().props


    return <>
        <Link className="btn btn-link text-light text-decoration-none" href={route('cart.show')}><i className="bi bi-bag pe-2"></i>Carrello
            <span className=" badge rounded-pill bg-danger">
                {Object.keys(cart.items).length}<span className="visually-hidden">elementi nel carrello</span>
            </span>
        </Link>
    </>

}