import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import Messages from "@react-src/components/Messages";
import { router, usePage } from "@inertiajs/react";
import { OrderState } from "@react-src/types";
import route from "ziggy-js";

export default function AdminOrderStateDeletePage() {

    const page = usePage<{ item: OrderState }>();
    const { item } = page.props;

    const doDelete = async () => {
        router.post(route("admin.order_state.destroy", { orderState: item }), { id: item.id });
    }

    return <>
        <BaseLayout title="Elimina stato">
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
                        <BreadcrumbLink href={route("admin.order_state.list")}>
                            Stati ordine
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Elimina stato</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col p-8 flex-grow space-y-2 items-start">
                <Messages></Messages>
                <p>Stai per eliminare lo stato <b>{item.name}</b>. Sei sicuro di volerlo fare?</p>
                <button type="submit" className="btn-success " onClick={() => doDelete()}>
                    Elimina
                </button>
            </div>
        </BaseLayout>

    </>

}
