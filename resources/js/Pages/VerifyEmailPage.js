import { Inertia } from '@inertiajs/inertia'
import { usePage } from '@inertiajs/inertia-react'
import React from 'react'
import Layout from '../components/Layout'

export default () => {

    const { user } = usePage().props

    return <>
        <Layout title="Verifica email" globalSearchEnabled={false}>
            <div className="g-0 row d-flex flex-grow-1">
                <div className="col-lg-12 p-4 d-flex flex-column align-items-center justify-content-center">
                    <div className="row d-flex flex-column align-items-center justify-content-center">
                        <div className="col-lg-6">
                            <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tua.
                                Ti abbiamo inviato su ({user.email}) un link da
                                cliccare per verificare la tua email.</p>
                            <div className='row g-0'>
                                <form className='col-4' onSubmit={(e) => {
                                    e.preventDefault();
                                    Inertia.post(route('verification.send'))
                                }}>

                                    <button className="btn btn-primary">Non ho ricevuto la mail</button>
                                </form>
                                <form className='col-4' onSubmit={(e) => {
                                    e.preventDefault();
                                    Inertia.post(route('logout'))
                                }}>
                                    <button className="btn btn-info">Esci da questo account</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </Layout>
    </>

}