import { yupResolver } from "@hookform/resolvers/yup";
import { router, usePage } from "@inertiajs/react";
import { DeliveryInfoFields } from "@react-src/types";
import { deliveryTypeValidator } from "@react-src/validators";
import { useState } from "react";
import { useForm } from "react-hook-form";
import route from "ziggy-js";


export default function AdminUpdateDeliveryInfo() {
    const page = usePage<{ order: any }>();
    const { order } = page.props;
    const [isEdit, setIsEdit] = useState(false);

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<DeliveryInfoFields>({
        resolver: yupResolver(deliveryTypeValidator),
        defaultValues: order
    });

    const onSubmit = async (data: DeliveryInfoFields) => {
        router.post(route("admin.order.updateOrderDeliveryInfo", { order: order }), data);
    }

    const preview = () => {
        return <>
            <div className="w-full flex flex-row p-4">
                <div className="w-full flex flex-col space-y-2">
                    <div className="w-full flex">
                        <label className="form-label">Informazioni consegna</label>
                    </div>
                    <div className="w-full flex flex-col">
                        <p>Nominativo: {order.user.firstname} {order.user.lastname}</p>
                        <p>Indirizzo: {order.delivery_address}</p>
                        <p>Orario di consegna: {order.delivery_time}</p>
                    </div>
                </div>
                <button className="flex" onClick={() => setIsEdit(!isEdit)}>
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
                <form className="w-full flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="w-full flex">
                        <label className="form-label">Informazioni consegna</label>
                    </div>
                    <div className="w-full flex flex-col">

                        <label >Indirizzo</label>
                        <input type="text" {...register("delivery_address")} className={errors.delivery_address ? "text-input-invalid" : "text-input"} defaultValue={order.delivery_address}></input>
                        <div className="invalid-feedback">
                            {errors.delivery_address?.message}
                        </div>
                        <label >Orario di consegna</label>
                        <input type="text" {...register("delivery_time")} className={errors.delivery_time ? "text-input-invalid" : "text-input"} defaultValue={order.delivery_time}></input>
                        <div className="invalid-feedback">
                            {errors.delivery_time?.message}
                        </div>
                    </div>
                    <div className="w-full flex items-center justify-end">
                        <button type="submit" className="btn-success flex flex-row space-x-2">
                            <span>Aggiorna</span>
                        </button>
                    </div>
                </form>
                <button className="flex" onClick={() => setIsEdit(!isEdit)}>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                        <path strokeLinecap="round" strokeLinejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </button>
            </div>
        </>
    }

    return <>
        {isEdit && order.is_shipping ? editForm() : preview()}
    </>
}
