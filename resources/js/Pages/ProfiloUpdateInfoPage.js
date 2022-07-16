import React, { useEffect, useState } from 'react'
import Layout from '../components/Layout'
import { useForm, usePage } from '@inertiajs/inertia-react'
import { Link } from '@inertiajs/inertia-react'
import Messages from '../components/Messages'
import Breadcrumb from '../components/Breadcrumb'


export default () => {
    const { flash, user } = usePage().props


    const { data, setData, put, processing, errors } = useForm({
        firstname: user.firstname,
        lastname: user.lastname,
    })

    function handleSubmit(e) {
        e.preventDefault()
        put(route('user-profile-information.update'))
    }

    const successMessage = () => {
        return <>
            <div className="row g-0">
                <div className="alert alert-success" role="alert">
                    Informazioni profilo aggiornate
                </div>
            </div>
        </>
    }

    return <>
        <Layout title="Informazioni profilo" globalSearchEnabled={false}>
            <Breadcrumb>
                <li className="breadcrumb-item">
                    <Link className='text-light' href={route("account.dashboard")}>Profilo</Link>
                </li>
                <li className="breadcrumb-item active text-light" aria-current="page">Informazioni personali</li>
            </Breadcrumb>
            <div className="col-lg-12 p-4">
                <div className="row g-0">
                    <Messages></Messages>
                </div>
                <div className="g-0 row d-flex flex-grow-1">
                    <div className="col-lg-12 ">
                        <h6>Compila il form per aggiornare i tuoi dati</h6>
                        <form className="row col-lg-4" onSubmit={handleSubmit}>

                            <div className="mb-3 form-group">
                                <label className="form-label">Email</label>
                                <input type="text" disabled={true} readOnly={true} value={user.email} className="form-control" />
                                <div id="emailHelp" className="form-text">L'indirizzo email non è modificabile</div>
                            </div>

                            <div className="mb-3 form-group">
                                <label className="form-label">Nome</label>
                                <input type="text" name="firstname" value={data.firstname} onChange={e => setData('firstname', e.target.value)} className={errors.firstname ? "form-control is-invalid" : "form-control"} />
                                <div className="invalid-feedback">
                                    {errors.firstname}
                                </div>
                            </div>
                            <div className="mb-3 form-group">
                                <label className="form-label">Cognome</label>
                                <input type="text" name="firstname" value={data.lastname} onChange={e => setData('lastname', e.target.value)} className={errors.lastname ? "form-control is-invalid" : "form-control"} />
                                <div className="invalid-feedback">
                                    {errors.lastname}
                                </div>
                            </div>
                            <div className="mb-3 form-group">
                                <button type="submit" className="btn btn-success"><i className="bi bi-pencil-square me-2"></i>Aggiorna informazioni</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Layout>
    </>

}