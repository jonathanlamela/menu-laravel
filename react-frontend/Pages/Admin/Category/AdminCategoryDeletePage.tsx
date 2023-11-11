import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import Messages from "@react-src/components/Messages";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import { router, usePage } from "@inertiajs/react";
import { Category } from "@react-src/types";
import route from "ziggy-js";


export default function AdminCategoryDeletePage() {

    const page = usePage<{ category: Category }>();
    const { category } = page.props;

    const doDelete = async () => {
        router.post(route("admin.category.destroy", { category: category }), { id: category.id });
    }

    return <>
        <BaseLayout title="Elimina categoria">
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
                    <li>
                        <BreadcrumbLink href={route("admin.category.list")}>
                            Categorie
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Elimina categoria</li>
                </ol>
            </HeaderMenu>

            <div className="flex flex-col p-8 flex-grow space-y-2 items-start ">
                <Messages></Messages>
                <p>Stai per eliminare la categoria <b>{category.name}</b>. Sei sicuro di volerlo fare?</p>
                <button type="submit" className="btn-success" onClick={() => doDelete()}>
                    Elimina
                </button>
            </div>
        </BaseLayout>
    </>
}
