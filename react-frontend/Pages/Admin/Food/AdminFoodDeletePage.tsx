import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import Messages from "@src/components/Messages";
import { UpdateFoodFields } from "@src/types";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";

export default function AdminFoodDeletePage() {
    const page = usePage<{ item: UpdateFoodFields }>();
    const { item } = page.props;

    const doDelete = async () => {
        router.post(route("admin.food.destroy", { food: item }), { id: item.id });
    }

    return <>
        <BaseLayout title="Elimina cibo">
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
                        <BreadcrumbLink href={route("admin.food.list")}>
                            Cibi
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Elimina cibo</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col p-8 flex-grow space-y-2 items-start">
                <Messages></Messages>
                <p>Stai per eliminare il cibo <b>{item.name}</b>. Sei sicuro di volerlo fare?</p>
                <button type="submit" className="btn-success " onClick={() => doDelete()}>
                    Elimina
                </button>
            </div>
        </BaseLayout>
    </>


}
