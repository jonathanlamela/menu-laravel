import React, { useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { Link, useForm } from '@inertiajs/inertia-react'
import Breadcrumb from '../components/Breadcrumb'

export default () => {



    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',

    })


    function handleSubmit(e) {
        e.preventDefault()
        post(route('login'))
    }

    return <>
        <Layout title="Accedi" globalSearchEnabled={false}>
            <Breadcrumb>
                <li className="breadcrumb-item">
                    <Link className='text-light' href={route("home")}>Home</Link>
                </li>
                <li className="breadcrumb-item active text-light" aria-current="page">Accedi</li>
            </Breadcrumb>
            <div className="row g-0">
                <Messages></Messages>
            </div>
            <div className="g-0 row d-flex flex-grow-1">
                <div className="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
                    <form className='row col-lg-4' onSubmit={handleSubmit}>
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
                        <div className="form-group">
                            <label htmlFor="inputPassword" className="col-form-label">Password</label>
                            <input type="password" name="password" className={errors.password ? "form-control is-invalid" : "form-control"}
                                value={data.password}
                                onChange={e => setData('password', e.target.value)} />
                            <div className="invalid-feedback">
                                {errors.password}
                            </div>
                        </div>
                        <div className="mt-3 form-group">
                            <Link className="justify-content-start text-decoration-none" href={route('password.request')}>Ho dimenticato la password</Link><br />
                            <Link className="justify-content-start text-decoration-none" href={route('register')}>Crea account</Link>
                        </div>
                        <div className="mt-3 form-group">
                            <button type="submit" className="btn btn-primary">Accedi</button>
                        </div>
                    </form>
                </div>
            </div>
        </Layout>
    </>

}