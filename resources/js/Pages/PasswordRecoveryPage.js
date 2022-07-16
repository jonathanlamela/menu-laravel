import React, { useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { useForm } from '@inertiajs/inertia-react'

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
            <div className='col-lg-12 p-4 d-flex flex-grow-1 flex-column'>
                <div className="row g-0">
                    <Messages></Messages>
                </div>
                <div className="g-0 row d-flex flex-grow-1">
                    <div className="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
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