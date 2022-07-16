import React, { useEffect, useState } from 'react'
import Layout from '../components/Layout'
import Messages from '../components/Messages'
import { useForm, usePage } from '@inertiajs/inertia-react'

export default () => {

    const page = usePage();


    const { data, setData, post, processing, errors } = useForm({
        password: '',
        password_confirmation: '',
        token: ''
    })

    useEffect(() => {
        setData('token', page.props.token);
    }, [])


    function handleSubmit(e) {
        e.preventDefault()
        post(route('password.update'))
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
                            <input type="hidden" name="token" value={data.token}></input>
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