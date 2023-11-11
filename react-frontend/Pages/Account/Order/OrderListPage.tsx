import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import HomeButton from "@react-src/components/HomeButton";
import { usePage } from "@inertiajs/react";
import MyOrderCard from "@react-src/pages/account/components/MyOrderCard";
import route from "ziggy-js";


export default function OrderListPage() {

    const page = usePage<{ orders: any[] }>();
    const { orders } = page.props;
    return <>
        <BaseLayout title="I miei ordini">
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
                        <BreadcrumbLink href={route("account.index")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>I miei ordini</li>
                </ol>
            </HeaderMenu>

            <div className="px-8 py-4">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">I miei ordini</p>
                </div>
                <div className="flex flex-col space-y-4 md:flex-row md:space-x-5 md:space-y-0">
                    {orders.length == 0 ? <p>Non ci sono ordini</p> : null}
                    {orders.map((item: any) => <MyOrderCard key={item.id} order={item}></MyOrderCard>)}
                </div>
            </div>
        </BaseLayout>
    </>
}
