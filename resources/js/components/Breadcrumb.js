import React from "react"

export default function Breadcrumb({ children }) {
    return <>
        <div className='col-lg-12 bg-secondary d-flex align-middle p-3'>
            <div className="row g-0">
                <nav aria-label="breadcrumb">
                    <ol className="breadcrumb m-0">
                        {children}
                    </ol>
                </nav>
            </div>
        </div>

    </>
}