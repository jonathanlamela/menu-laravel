import { Link } from "@inertiajs/inertia-react"
import React from "react"
export default function HomeButton() {
    return <>
        <Link className="btn btn-link text-light text-decoration-none"
            href={route('home')}><i className="bi bi-house pe-2"></i>Home</Link>
    </>

}