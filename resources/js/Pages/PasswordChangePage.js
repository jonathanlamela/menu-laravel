import React, { useEffect, useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { useForm, usePage, Link } from '@inertiajs/inertia-react'
import Breadcrumb from '../components/Breadcrumb'

export default () => {



    const { data, setData, put, processing, errors } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    })




    function handleSubmit(e) {
        e.preventDefault()
        put(route('user-password.update'))
    }



    return <>
        <Layout title="Cambia password" globalSearchEnabled={false}>
            <Breadcrumb>
                <li className="breadcrumb-item">
                    <Link className='text-light' href={route("account.dashboard")}>Profilo</Link>
                </li>
                <li className="breadcrumb-item active text-light" aria-current="page">Cambia password</li>
            </Breadcrumb>
            <div className='col-lg-12 p-4 d-flex flex-grow-1 flex-column'>
                <div className="row g-0">
                    <Messages></Messages>
                </div>
                <div className="row g-0 d-flex flex-grow-1">
                    <div className="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
                        <form className="row col-lg-4" onSubmit={handleSubmit}>
                            <div className="form-group">
                                <label htmlFor="inputPassword" className="col-form-label">Password attuale</label>
                                <input type="password" name="password" className={errors.current_password ? "form-control is-invalid" : "form-control"}
                                    value={data.current_password}
                                    onChange={e => setData('current_password', e.target.value)} />
                                <div className="invalid-feedback">
                                    {errors.current_password}
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
                                <button type="submit" className="btn btn-primary">Cambia password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </Layout>
    </>

}