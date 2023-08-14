import { useCallback, useEffect, useState } from "react";
import { Link, useNavigate, useParams } from "react-router-dom";
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import Messages from "@src/components/Messages";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import { router, usePage } from "@inertiajs/react";
import { Category } from "@src/types";
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
                        <BreadcrumbLink href="/amministrazione/categorie">
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
