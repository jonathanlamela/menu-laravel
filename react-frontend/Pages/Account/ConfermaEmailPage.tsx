import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import { yupResolver } from '@hookform/resolvers/yup';
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import HomeButton from "@src/components/HomeButton";
import { LoginFields } from "@src/types";
import { loginValidator } from "@src/validators";
import { Link, usePage } from "@inertiajs/react";
import { router } from "@inertiajs/core";
import route from "ziggy-js";

export default function ConfermaEmailPage() {

    const page = usePage<{ backUrl: string | null }>();


    const user: any = page.props.user;



    const onRequireNewEmail = (e: any) => {
        e.preventDefault();
        router.post(route('verification.send'));
    }

    const onRequireLogout = (e: any) => {
        e.preventDefault();
        router.post(route('logout'));
    }

    return <>

        <BaseLayout title='Accedi'>
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
                        <BreadcrumbLink href={route("login")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Attivazione account</li>
                </ol>
            </HeaderMenu>
            <div className="px-8 pt-8">
                <Messages></Messages>
            </div>
            <div className='flex flex-grow flex-col justify-center items-center'>
                <div className='flex flex-grow justify-center items-center'>
                    <div className="flex flex-col space-y-2 w-full md:w-1/2">
                        <p>Il tuo account è stato creato, ma dobbiamo verificare che la mail sia realmente tua.
                            Ti abbiamo inviato su {user.email}  un link da
                            cliccare per verificare la tua email.</p>
                        <div className="flex flex-row space-x-2">
                            <form onSubmit={onRequireNewEmail}>
                                <button className="btn btn-primary">Non ho ricevuto la mail</button>
                            </form>
                            <form className="m-0" onSubmit={onRequireLogout}>
                                <button className="btn btn-secondary-outlined">Esci da questo account</button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </BaseLayout>
    </>
}


