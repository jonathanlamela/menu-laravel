import { Link } from "@inertiajs/inertia-react"
import React from "react"


export default function Header() {
    return <>
        <div className="col-lg-12 app-title d-flex justify-content-center align-items-center flex-column p-4 bg-primary">
            <div className="text-center">
                <Link href={route('home')} className="text-decoration-none text-light">
                    <h2 style={{ fontFamily: 'Smooch, cursive' }}>DaFittizzio</h2>
                    <p>RISTORANTE PIZZERIA</p>
                </Link>
            </div>
        </div>
    </>
}