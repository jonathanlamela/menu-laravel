import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import { yupResolver } from '@hookform/resolvers/yup';
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import HomeButton from "@react-src/components/HomeButton";
import { CurrentUser, LoginFields } from "@react-src/types";
import { loginValidator } from "@react-src/validators";
import { Link, usePage } from "@inertiajs/react";
import { router } from "@inertiajs/core";
import route from "ziggy-js";

export default function ConfermaEmailPage() {

    const page = usePage<{ backUrl: string | null, user: CurrentUser }>();
    const { user } = page.props;



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
                            Accedi
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


