import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import { useState, useCallback, useEffect } from "react";

import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import Messages from "@src/components/Messages";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import LoadingContent from "@src/components/LoadingContent";
import { usePage } from "@inertiajs/react";
import { Page } from "@inertiajs/inertia";

export default function AdminOrderStateDeletePage() {

    const page = usePage<Page<{ item: any }>>();
    const { item } = page.props;
    const [isPending, setIsPending] = useState(false);

    const doDelete = async () => {
        setIsPending(true);
        //TODO
        setIsPending(false);
    }

    if (item) {
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
                            <BreadcrumbLink href="/amministrazione/stati-ordine">
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
                        <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                        Elimina
                    </button>
                </div>
            </BaseLayout>
        </>
    } else {
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
                            <BreadcrumbLink href="/amministrazione/stati-ordine">
                                Stati ordine
                            </BreadcrumbLink>
                        </li>
                        <li>::</li>
                        <li>Elimina stato</li>
                    </ol>
                </HeaderMenu>
                <Messages></Messages>
                <LoadingContent></LoadingContent>
            </BaseLayout>
        </>
    }

}
