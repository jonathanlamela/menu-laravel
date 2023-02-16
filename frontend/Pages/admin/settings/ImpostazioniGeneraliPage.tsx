import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import { useCallback, useEffect, useState } from "react";
import { useForm } from "react-hook-form";

import OrderStateFields from "@src/types/admin/OrderStateFields";
import SettingFields from "@src/types/admin/SettingFields";
import settingValidator from "@src/validators/settingValidator";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import { usePage } from "@inertiajs/inertia-react";
import { Page } from "@inertiajs/inertia";

export default function ImpostazioniGeneraliPage() {

    const [isPending, setIsPending] = useState(false);

    const page = usePage<Page<{ orderStates: any[], item: any[] }>>()

    const { orderStates, item } = page.props;

    const settings = Object.assign(
        {},
        ...item.map((x: any) => ({ [x.name]: x.value })),
    )

    const { register, handleSubmit, formState: { errors }, setValue } = useForm<SettingFields>({
        resolver: yupResolver(settingValidator),
        defaultValues: settings
    });

    const onSubmit = async (data: SettingFields) => {

        setIsPending(true);

        //TODO

        setIsPending(false);

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
                        <BreadcrumbLink href="/account">
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Impostazioni negozio</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col p-8 flex-grow">
                <Messages></Messages>
                <div className="w-full">
                    <p className="text-2xl antialiased font-bold">Impostazioni</p>
                </div>
                <form className="pt-4 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <h6 className="font-semibold uppercase">Informazioni del sito</h6>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Nome del sito</label>
                        <input type="text"
                            {...register("site_name")}
                            className={errors.site_name ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.site_name?.message}
                        </div>
                    </div>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Motto del sito</label>
                        <input type="text"
                            {...register("site_subtitle")}
                            className={errors.site_subtitle ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.site_subtitle?.message}
                        </div>
                    </div>
                    <h6 className="font-semibold uppercase">Impostazioni ordini</h6>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Spese di consegna</label>
                        <input type="text"
                            {...register("shipping_costs")}
                            className={errors.shipping_costs ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.shipping_costs?.message}
                        </div>
                    </div>


                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Stato quando l'ordine viene creato</label>
                        <select {...register("order_created_state_id")}
                            className={errors.order_created_state_id ? "text-input-invalid" : "text-input"}>
                            {orderStates.map((state: { id: number, name: string }) => <option value={state.id} key={state.id}>{state.name}</option>)}

                        </select>
                        <div className="invalid-feedback">
                            {errors.order_created_state_id?.message}
                        </div>
                    </div>
                    <div className="w-full md:w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Stato quando l'ordine viene pagato</label>
                        <select {...register("order_paid_state_id")}
                            className={errors.order_paid_state_id ? "input-select-invalid" : "input-select"}>
                            {orderStates.map((state: { id: number, name: string }) => <option value={state.id} key={state.id}>{state.name}</option>)}
                        </select>
                        <div className="invalid-feedback">
                            {errors.order_paid_state_id?.message}
                        </div>
                    </div>


                    <div className="w-1/3 flex flex-col space-y-2 items-start">
                        <button type="submit" className="btn-success">
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            Aggiorna
                        </button>
                    </div>
                </form>
            </div>


        </BaseLayout>
    </>
}
