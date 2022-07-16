import React from "react"
import { Link, usePage } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia'

export default function UserManager() {
    const { user } = usePage().props

    const handleSubmit = (e) => {
        e.preventDefault();
        Inertia.post(route('logout'))
    }

    if (user) {

        return <>
            <Link className="btn btn-link text-light text-decoration-none" href={route('account.dashboard')}><i className="bi bi-globe2 pe-2"></i>Profilo</Link>
            <form className="m-0" onSubmit={handleSubmit}>
                <button className="btn btn-link text-light text-decoration-none"><i className="bi-box-arrow-right pe-2"></i>Esci</button>
            </form>
        </>
    } else {
        return <>
            <Link className="btn btn-link text-light text-decoration-none" href={route('login')}><i className="bi bi-person pe-2"></i>Accedi</Link>
        </>
    }


}