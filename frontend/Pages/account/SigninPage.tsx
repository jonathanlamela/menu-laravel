import { useForm } from "react-hook-form";

import { yupResolver } from '@hookform/resolvers/yup';
import { useState } from "react";

import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import SigninFields from "@src/types/SigninFields";
import signinValidator from "@src/validators/signinValidator";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import Messages from "@src/components/Messages";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import { router, usePage } from "@inertiajs/react";
import { Page } from "@inertiajs/inertia";
import route from "ziggy-js";


export default function SigninPage() {

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<SigninFields>({
        resolver: yupResolver(signinValidator),
        defaultValues: {
            source: "web"
        },
        mode: "onSubmit",
        reValidateMode: "onChange"
    });

    const page = usePage<Page<{ errors?: any }>>();



    const onSubmit = async (data: SigninFields) => {
        setIsPending(true);
        router.post(page.url, data);
        setIsPending(false);
    }
    const [isPending, setIsPending] = useState(false);

    return <>
        <BaseLayout title='Crea account'>
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
                    <li>Crea account</li>
                </ol>
            </HeaderMenu>
            <div className="px-8 pt-8">
                <Messages></Messages>
            </div>
            <div className='flex flex-grow justify-center items-start md:items-center'>
                <form onSubmit={handleSubmit(onSubmit)} className="w-full p-8 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" >
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Nome</label>
                        <input type="text"
                            {...register("firstname")}
                            className={errors.firstname ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.firstname?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Cognome</label>
                        <input type="text"
                            {...register("lastname")}
                            className={errors.lastname ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.lastname?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Email</label>
                        <input type="text"
                            {...register("email")}
                            className={errors.email ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.email?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Password</label>
                        <input type="password"
                            {...register("password")}
                            className={errors.password ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.password?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Conferma password</label>
                        <input type="password"
                            {...register("confirmPassword")}
                            className={errors.confirmPassword ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.confirmPassword?.message}
                        </div>
                    </div>
                    <div className="flex flex-row space-x-2">
                        <button type="submit" className="btn-primary space-x-2">
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            <span>Crea account</span>
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
