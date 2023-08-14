import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useForm } from "react-hook-form";


import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import { OrderState, Settings } from "@react-src/types";
import { settingValidator } from "@react-src/validators";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";

export default function ImpostazioniGeneraliPage() {

    const page = usePage<{ item: Settings, order_states: OrderState[] }>();
    const { item, order_states } = page.props;

    const { register, handleSubmit, formState: { errors } } = useForm<Settings>({
        resolver: yupResolver(settingValidator),
        defaultValues: item
    });

    const onSubmit = async (data: Settings) => {
        router.post(route("admin.impostazioni.generali"), data);
    }

    return <>
        <BaseLayout title="Impostazioni generali">
            <Topbar>
                <TopbarLeft>
                    <HomeButton></HomeButton>
                </TopbarLeft>
                <TopbarRight>
                    <CartButton></CartButton>
                    <AccountManage></AccountManage>
                </TopbarRight>
            </Topbar>

            <Header></Header>
            <HeaderMenu>
                <ol className="flex h-16 flex-row space-x-2 items-center pl-8 text-white">
                    <li>
                        <BreadcrumbLink href={route("account.dashboard")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Impostazioni negozio</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col px-8 py-4 flex-grow">
                <Messages></Messages>
                <div className="w-full">
                    <p className="text-2xl antialiased font-bold">Impostazioni</p>
                </div>
                <form className="pt-4 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <h6 className="font-semibold uppercase">Informazioni del sito</h6>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Nome del sito</label>
                        <input
                            type="text"
                            {...register("site_title")}
                            className={errors.site_title ? "text-input-invalid" : "text-input"}
                        />
                        <div className="invalid-feedback">{errors.site_title?.message}</div>
                    </div>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Motto del sito</label>
                        <input
                            type="text"
                            {...register("site_subtitle")}
                            className={errors.site_subtitle ? "text-input-invalid" : "text-input"}
                        />
                        <div className="invalid-feedback">{errors.site_subtitle?.message}</div>
                    </div>
                    <h6 className="font-semibold uppercase">Impostazioni ordini</h6>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Spese di consegna</label>
                        <input
                            type="text"
                            {...register("shipping_costs")}
                            className={errors.shipping_costs ? "text-input-invalid" : "text-input"}
                        />
                        <div className="invalid-feedback">{errors.shipping_costs?.message}</div>
                    </div>

                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Stato quando l'ordine viene creato</label>
                        <select
                            {...register("order_created_state_id")}
                            className={errors.order_created_state_id ? "text-input-invalid" : "text-input"}
                        >
                            <option>-- Nessuna opzione --</option>
                            {order_states.map((state: { id: number, name: string }) => (
                                <option value={state.id} key={state.id}>
                                    {state.name}
                                </option>
                            ))}
                        </select>
                        <div className="invalid-feedback">{errors.order_created_state_id?.message}</div>
                    </div>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Stato quando l'ordine viene pagato</label>
                        <select
                            {...register("order_paid_state_id")}
                            className={errors.order_paid_state_id ? "input-select-invalid" : "input-select"}
                        >
                            <option>-- Nessuna opzione --</option>
                            {order_states.map((state: { id: number, name: string }) => (
                                <option value={state.id} key={state.id}>
                                    {state.name}
                                </option>
                            ))}
                        </select>
                        <div className="invalid-feedback">{errors.order_paid_state_id?.message}</div>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2 items-start">
                        <button type="submit" className="btn-success">
                            Aggiorna
                        </button>
                    </div>
                </form>
            </div>


        </BaseLayout >
    </>
}
