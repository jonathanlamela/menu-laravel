import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import { Link, router, usePage } from "@inertiajs/react";
import route from "ziggy-js";
import { OrderState } from "@react-src/types";
import { useForm } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import { updateOrderStatusValidator } from "@react-src/validators";
import axios from "axios";
import { useState } from "react";
import ButtonCircularProgress from "@react-src/components/ButtonCircularProgress";

export default function AdminOrderListPage() {
    const page = usePage<{ order: any, order_states: OrderState[] }>();
    const { order, order_states } = page.props;

    const [isPending, setIsPending] = useState(false);

    const formOrderState
        = useForm<{ order_state: number }>({
            resolver: yupResolver(updateOrderStatusValidator),
            defaultValues: {
                order_state: order.order_state_id
            }
        });

    const onOrderStatusSubmit = async (data: { order_state: number }) => {

        setIsPending(true)
        await axios.post(route("admin.order.updateOrderState", { order: order }), {
            order_state_id: data.order_state
        })
        setTimeout(() => {
            setIsPending(false)
        }, 500)
    }

    return <>
        <BaseLayout title={`Ordine ${order.id}`}>
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
                <ol className="flex flex-row space-x-2 items-center h-16 pl-8 text-white">
                    <li>
                        <BreadcrumbLink href={route("account.dashboard")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>
                        <BreadcrumbLink href={route("admin.order.list")}>
                            Ordini
                        </BreadcrumbLink>
                    </li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col px-8 py-4 flex-grow">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">{`Ordine N. ${order.id}`}</p>
                </div>
                <div className="w-full">
                    <form className="py-2 px-2 w-full lg:w-1/2 flex flex-row space-x-2 items-center bg-slate-100  shadow" onSubmit={formOrderState.handleSubmit(onOrderStatusSubmit)}>
                        <div className="w-1/4 flex justify-end text-right">
                            <label className="form-label">Stato ordine</label>
                        </div>
                        <div className="w-full flex flex-row">
                            <select
                                {...formOrderState.register("order_state")}
                                className={formOrderState.formState.errors.order_state ? "w-full text-input-invalid" : "w-full text-input"}
                            >
                                {order_states.map((state: { id: number, name: string }) => (
                                    <option value={state.id} key={state.id}>
                                        {state.name}
                                    </option>
                                ))}
                            </select>
                            <div className="invalid-feedback">{formOrderState.formState.errors.order_state?.message}</div>
                        </div>
                        <div className="w-1/4 flex flex-col space-y-2 items-start">
                            <button type="submit" className="btn-success flex flex-row space-x-2" disabled={isPending}>
                                <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                                <span>Aggiorna</span>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </BaseLayout>
    </>
}
