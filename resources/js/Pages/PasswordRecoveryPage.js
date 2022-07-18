import React, { useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { useForm, Link } from '@inertiajs/inertia-react'
import Breadcrumb from '../components/Breadcrumb'

export default () => {

    const { data, setData, post, processing, errors } = useForm({
        email: '',
    })


    function handleSubmit(e) {
        e.preventDefault()
        post(route('password.email'))
    }

    return <>
        <Layout title="Recupera password" globalSearchEnabled={false}>
            <div className='col-lg-12 d-flex flex-grow-1 flex-column'>
                <Breadcrumb>
                    <li className="breadcrumb-item">
                        <Link className='text-light' href={route("home")}>Home</Link>
                    </li>
                    <li className="breadcrumb-item active text-light" aria-current="page">Recupera password</li>
                </Breadcrumb>
                <div className="row g-0 ps-4 pe-4 pt-4">
                    <Messages></Messages>
                </div>
                <div className="row g-0  d-flex flex-grow-1 ps-4 pe-4 pt-4">
                    <div className="col-lg-12 d-flex flex-column align-items-center justify-content-center">
                        <form className="row col-lg-4" onSubmit={handleSubmit}>
                            <div className="form-group">
                                <label htmlFor="staticEmail" className="col-form-label">Email</label>
                                <input
                                    type="text"
                                    name="email"
                                    className={errors.email ? "form-control is-invalid" : "form-control"}
                                    value={data.email}
                                    onChange={e => setData('email', e.target.value)} />
                                <div className="invalid-feedback">
                                    {errors.email}
                                </div>
                            </div>
                            <div className="form-group mt-3">
                                <button type="submit" className="btn btn-primary">Recupera password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Layout>
    </>

}