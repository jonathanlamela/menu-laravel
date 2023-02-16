import { yupResolver } from "@hookform/resolvers/yup";
import { useForm } from "react-hook-form";

import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import VerifyAccountFields from "@src/types/VerifyAccountFields";
import verifyAccountValidator from "@src/validators/verifyAccountValidator";
import { useState } from "react";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import route from "ziggy-js";
import { Page } from "@inertiajs/inertia";
import { router, usePage } from "@inertiajs/react";


export default function VerificaAccountPage() {

    const page = usePage<Page<{ user?: any }>>();
    const { user } = page.props;

    const resendEmail = () => {
        router.post(route('verification.send'))
    }

    return <>
        <BaseLayout title='Verifica account'>
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
                <ol className="flex flex-row space-x-2 items-center pl-8 text-white h-16">
                    <li>
                        <BreadcrumbLink href="/account/login">
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Verifica account</li>
                </ol>
            </HeaderMenu>

            <div className='p-8'>
                <Messages></Messages>
                <div className="flex flex-col space-y-2 items-start">
                    <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tua.
                        Ti abbiamo inviato, all'indirizzo {user?.email}, un link da
                        cliccare per verificare la tua email.</p>
                    <button onClick={() => resendEmail()} className="btn-primary">Non ho ricevuto la mail</button>
                    <button onClick={() => { router.post(route('logout')) }} className="btn-secondary">Esci da questo account</button>
                </div>
            </div>
        </BaseLayout>
    </>
}
