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

import AdminUpdateOrderState from "@react-src/pages/admin/order/components/AdminUpdateOrderState";
import AdminUpdateDeliveryType from "@react-src/pages/admin/order/components/AdminUpdateDeliveryType";
import AdminUpdateDeliveryInfo from "@react-src/pages/admin/order/components/AdminUpdateDeliveryInfo";
import AdminUpdateOrderDetail from "@react-src/pages/admin/order/components/AdminUpdateOrderDetail";
import AdminUpdateOrderSummary from "@react-src/pages/admin/order/components/AdminUpdateOrderSummary";
import AdminUpdaterOrderNote from "@react-src/pages/admin/order/components/AdminUpdaterOrderNote";

export default function AdminOrderListPage() {
    const page = usePage<{ order: any, order_states: OrderState[] }>();
    const { order } = page.props;

    const informazioniConsegna = () => {
        return <>
            <div className="w-full lg:w-1/2 border border-gray-200  p-2 flex flex-col space-y-2 items-center">
                <AdminUpdateDeliveryInfo></AdminUpdateDeliveryInfo>
            </div>
        </>
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
                        <BreadcrumbLink href={route("account.index")}>
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
            <div className="flex flex-col px-8 py-4 flex-grow space-y-2">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">{`Ordine N. ${order.id}`}</p>
                </div>
                <div className="hidden flex-row lg:flex space-x-2">
                    <div className="w-1/2 flex flex-col space-y-2">
                        <div className="w-full border border-gray-200 p-2 flex flex-col space-y-2 items-center ">
                            <AdminUpdateOrderState></AdminUpdateOrderState>
                        </div>
                        <div className="w-full border border-gray-200 p-2 flex flex-col space-y-2 items-center ">
                            <AdminUpdateDeliveryType></AdminUpdateDeliveryType>
                        </div>
                    </div>
                    <div className="w-1/2">
                        {order.is_shipping ? <>
                            <div className="w-full border border-gray-200 mb-2 p-2 flex flex-col items-center">
                                <AdminUpdateDeliveryInfo></AdminUpdateDeliveryInfo>
                            </div>
                        </> : null}
                    </div>
                </div>
                <div className="flex flex-col lg:hidden space-y-2">
                    <div className="w-full lg:w-1/2 border border-gray-200  p-2 flex flex-col space-y-2 items-center ">
                        <AdminUpdateOrderState></AdminUpdateOrderState>
                    </div>
                    <div className="w-full lg:w-1/2 border border-gray-200  p-2 flex flex-col space-y-2 items-center ">
                        <AdminUpdateDeliveryType></AdminUpdateDeliveryType>
                    </div>
                    {order.is_shipping ? informazioniConsegna() : null}
                </div>
                <div className="w-full flex">
                    <div className="w-full border border-gray-200  p-2 flex flex-col space-y-2 items-center ">
                        <AdminUpdateOrderDetail></AdminUpdateOrderDetail>
                    </div>
                </div>
                <div className="w-full flex">
                    <div className="w-full border border-gray-200  p-2 flex flex-col space-y-2 items-center ">
                        <AdminUpdaterOrderNote></AdminUpdaterOrderNote>
                    </div>
                </div>
                <div className="w-full flex">
                    <div className="w-full border border-gray-200  p-2 flex flex-col space-y-2 items-center ">
                        <AdminUpdateOrderSummary></AdminUpdateOrderSummary>
                    </div>
                </div>

            </div >
        </BaseLayout>
    </>
}