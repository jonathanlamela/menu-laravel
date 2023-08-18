import { yupResolver } from "@hookform/resolvers/yup";
import { router, usePage } from "@inertiajs/react";
import { DeliveryInfoFields } from "@react-src/types";
import { deliveryTypeValidator } from "@react-src/validators";
import { useState } from "react";
import { useForm } from "react-hook-form";
import route from "ziggy-js";


export default function AdminUpdateOrderSummary() {
    const page = usePage<{ order: any }>();
    const { order } = page.props;
    const [isEdit, setIsEdit] = useState(false);

    console.log(order);


    const [isTransitioning, setIsTransitioning] = useState(false); // Nuovo stato
    const toggleEdit = () => {
        setIsTransitioning(true);
        setTimeout(() => {
            setIsEdit(!isEdit);
            setIsTransitioning(false);
        }, 300); // Regola questa durata in millisecondi in base alle tue preferenze di animazione
    };



    const preview = () => {
        return <>
            <div className="w-full flex flex-row p-4">
                <div className="w-full flex flex-col space-y-2">
                    <div className="w-full flex">
                        <label className="form-label">Riepilogo</label>
                    </div>
                    <div className="w-full flex flex-col">
                        <p>Totale: {order.total.toFixed(2)} €</p>
                    </div>
                </div>
                <button className="flex" onClick={() => toggleEdit()}>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </button>
            </div>
        </>
    }

    const editForm = () => {
        return <>
            <div className="w-full flex flex-row p-4 space-x-4">
                <div className="w-full flex flex-col space-y-2" >
                    <div className="w-full flex">
                        <label className="form-label">Riepilogo</label>
                    </div>
                    <div className="w-full flex flex-col">
                        <p>Totale: {order.total.toFixed(2)} €</p>
                    </div>
                </div>
                <button className="flex" onClick={() => toggleEdit()}>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </button>
            </div>
        </>
    }

    return (
        <div className={`w-full transition-opacity ${isTransitioning ? "opacity-0" : "opacity-100"}`}>
            {isEdit ? editForm() : preview()}
        </div>
    );
}
