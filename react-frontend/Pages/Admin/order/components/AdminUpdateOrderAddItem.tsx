import { yupResolver } from "@hookform/resolvers/yup";
import { router, usePage } from "@inertiajs/react";
import { Settings } from "@react-src/types";
import { updateOrderDetailsAddItemValidator } from "@react-src/validators";
import { useEffect } from "react";
import { useForm } from "react-hook-form";
import route from "ziggy-js";


export default function AdminUpdateOrderAddItem() {
    const page = usePage<{ order: any, foods: any[], settings: Settings }>();
    const { order, foods, settings } = page.props;

    foods.push({
        name: "Spese di consegna",
        price: settings.shipping_costs,
        category: {
            name: "Servizi"
        }
    })

    const { register, handleSubmit, formState: { errors } }
        = useForm<{ id: number }>({
            resolver: yupResolver(updateOrderDetailsAddItemValidator),

        });

    const onItemAddSubmit = async (data: { id: number }) => {
        const food = foods[data.id];
        router.post(route("admin.order.add_order_detail", { order: order }), { name: food.name, price: food.price });
    }

    return <>
        <form className="w-full flex flex-row items-center space-x-2" onSubmit={handleSubmit(onItemAddSubmit)}>
            <div className="w-3/4">
                <select {...register("id")}
                    className={errors.id ? "w-full text-input-invalid" : "w-full text-input"}>

                    {foods.map((food: any, index: number) => (
                        <option value={index} key={food.id}>
                            {food.name} ({food.category.name}) - {food.price.toFixed(2)} €
                        </option>
                    ))}
                </select>
                <div className="invalid-feedback">
                    {errors.id?.message}
                </div>
            </div>
            <div className="flex w-1/4 items-center">
                <button type="submit" className="btn btn-success">Aggiungi</button>
            </div>
        </form>
    </>
}
