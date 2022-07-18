import { usePage } from '@inertiajs/inertia-react'
import React from 'react'

export default () => {

    const { flash } = usePage().props;


    if (flash.success_message) {
        return <>

            <div className="alert alert-success" role="alert">
                {flash.success_message}
            </div>

        </>
    } else if (flash.error_message) {
        return <>

            <div className="alert alert-danger" role="alert">
                {flash.danger_message}
            </div>

        </>
    } else if (flash.info_message) {
        return <>

            <div className="alert alert-info" role="alert">
                {flash.info_message}
            </div>

        </>
    } else if (flash.status_message) {

        switch (flash.status_message) {
            case "password-updated":
                return <>
                    <div className="alert alert-success" role="alert">
                        Password cambiata con successo
                    </div>
                </>
            case "profile-information-updated":
                return <>
                    <div className="alert alert-success" role="alert">
                        Informazioni profilo aggiornate
                    </div>
                </>
            default:
                return <>
                    <div className="alert alert-info" role="alert">
                        {flash.status_message}
                    </div>
                </>
        }

    } else {
        return <></>
    }





}