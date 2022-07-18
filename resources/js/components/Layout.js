import React from "react"
import GlobalSearch from "./GlobalSearch"
import HomeButton from "./HomeButton"
import Header from "./Header"
import { Head } from '@inertiajs/inertia-react'
import CartButton from "./CartButton"
import UserManager from "./UserManager"

export default function Layout({ title, children, globalSearchEnabled, nav }) {
    return <>
        <Head>
            <title>{title ? `${title} :: Pizzeria Fittizzio` : 'Pizzeria Fittizzio'}</title>
        </Head>
        <div className="container-sm d-flex flex-column flex-grow-1 p-0">
            <div className="shadow bg-white d-flex flex-column flex-grow-1">
                <div className="col-lg-12 d-flex flex-column flex-grow-1">
                    <div className="g-0 row">
                        <div className="col-lg-12">
                            <div className="row g-0 bg-primary">
                                <div className="col-lg-8 d-flex justify-content-center justify-content-md-center justify-content-lg-start align-items-center p-2">
                                    {globalSearchEnabled ? <GlobalSearch></GlobalSearch> : <HomeButton></HomeButton>}
                                </div>
                                <div className="col-lg-4 d-flex justify-content-center justify-content-md-center justify-content-lg-end align-items-center p-2">
                                    <CartButton></CartButton>
                                    <UserManager></UserManager>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row g-0">
                        <Header></Header>
                    </div>
                    <div className="row g-0">
                        {nav ? nav : null}
                    </div>
                    <div className="row g-0 d-flex flex-column flex-grow-1">
                        {children}
                    </div>
                </div>
            </div>
        </div>
    </>

}

/**
 * 
 * <div className="container w-75 d-flex flex-column flex-grow-1">
            <div className="shadow bg-white d-flex flex-column flex-grow-1">
                <div className="col-lg-12 d-flex flex-column flex-grow-1">
                    <div className="g-0 row">
                        <div className="col-lg-12">
                            <div className="row g-0 bg-primary">
                                <div className="col-lg-8 d-flex justify-content-center justify-content-md-center justify-content-lg-start align-items-center p-2">
                                    {% block topbar-left %}
                                    {% endblock topbar-left %}
                                </div>
                                <div className="col-lg-4 d-flex justify-content-center justify-content-md-center justify-content-lg-end align-items-center p-2">
                                    {% block topbar-right %}
                                    {% endblock topbar-right %}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="row g-0">
                        {% block header %}
                        {% endblock header %}
                    </div>
                    <div className="row g-0">
                        {% block nav %}
                        {% endblock nav %}
                    </div>
                    <div className="row g-0 d-flex flex-column flex-grow-1">
                        {% block content %}
                        {% endblock content %}
                    </div>
                </div>
            </div>
        </div>
 * 
 */