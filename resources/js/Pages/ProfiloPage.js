import { usePage } from '@inertiajs/inertia-react'
import React from 'react'
import AdminPanel from '../components/AdminPanel'
import Layout from '../components/Layout'
import Messages from "../components/Messages";
import { Link } from '@inertiajs/inertia-react'
import Breadcrumb from '../components/Breadcrumb'
export default () => {
    const { user } = usePage().props

    return <>
        <Layout title="Profilo" globalSearchEnabled={false}>
            <Breadcrumb>
                <li className="breadcrumb-item active text-light" aria-current="page">Profilo</li>
                <li className="breadcrumb-item active text-light" aria-current="page">{user.firstname} {user.lastname}</li>
            </Breadcrumb>
            <div className="row g-0">
                <Messages></Messages>
            </div>
            <div className="g-0 row d-flex flex-grow-1">
                <div className="col-lg-12 p-4 d-flex flex-column align-items-start justify-content-start">
                    <div className="row g-0">
                        <div className='col-lg-12 d-flex flex-column'>
                            <h4>Il mio profilo</h4>
                            <Link className="text-decoration-none" href={route('account.informazioni-personali')}><i className="bi bi-person-lines-fill me-2"></i>
                                Informazioni personali</Link>
                            <Link className="text-decoration-none" href={route('account.cambia-password')}><i className="bi bi-key me-2"></i>
                                Cambia la password</Link>
                            <Link className="text-decoration-none" href={route('ordini.list')}><i className="bi bi-bag me-2"></i>
                                I miei ordini </Link>
                        </div>
                    </div>
                    {user.role == "admin" ? <AdminPanel></AdminPanel> : null}
                </div>
            </div>
        </Layout>
    </>

}