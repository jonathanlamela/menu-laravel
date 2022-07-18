import React, { useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { Link, useForm } from '@inertiajs/inertia-react'
import Breadcrumb from '../components/Breadcrumb'

export default () => {

    const { data, setData, post, processing, errors } = useForm({
        email: '',
        password: '',
        password_confirmation: '',
        firstname: '',
        lastname: ''
    })


    function handleSubmit(e) {
        e.preventDefault()
        post(route('register'))
    }

    return <>
        <Layout title="Crea account" globalSearchEnabled={false}>
            <Breadcrumb>
                <li className="breadcrumb-item">
                    <Link className='text-light' href={route("home")}>Home</Link>
                </li>
                <li className="breadcrumb-item active text-light" aria-current="page">Crea account</li>
            </Breadcrumb>
            <div className="row g-0">
                <Messages></Messages>
            </div>
            <div className="g-0 row d-flex flex-grow-1">
                <div className="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
                    <form className="row col-lg-4" onSubmit={handleSubmit}>
                        <div className="form-group">
                            <label className="col-form-label">Nome</label>
                            <input
                                type="text"
                                name="firstname"
                                className={errors.firstname ? "form-control is-invalid" : "form-control"}
                                value={data.firstname}
                                onChange={e => setData('firstname', e.target.value)} />
                            <div className="invalid-feedback">
                                {errors.firstname}
                            </div>
                        </div>
                        <div className="form-group">
                            <label className="col-form-label">Cognome</label>
                            <input
                                type="text"
                                name="lastname"
                                className={errors.lastname ? "form-control is-invalid" : "form-control"}
                                value={data.lastname}
                                onChange={e => setData('lastname', e.target.value)} />
                            <div className="invalid-feedback">
                                {errors.lastname}
                            </div>
                        </div>
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
                        <div className="form-group">
                            <label htmlFor="inputPassword" className="col-form-label">Conferma password</label>
                            <input type="password" name="password_confirmation" className={errors.password_confirmation ? "form-control is-invalid" : "form-control"}
                                value={data.password_confirmation}
                                onChange={e => setData('password_confirmation', e.target.value)} />
                            <div className="invalid-feedback">
                                {errors.password_confirmation}
                            </div>
                        </div>
                        <div className="form-group mt-3">
                            <button type="submit" className="btn btn-primary">Crea account</button>
                        </div>
                    </form>
                </div>
            </div>
        </Layout>
    </>

}