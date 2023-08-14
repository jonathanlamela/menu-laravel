import { useForm } from "react-hook-form";

import { yupResolver } from '@hookform/resolvers/yup';
import { useEffect, useState } from "react";
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
import { SigninFields } from "@react-src/types";
import { signinValidator } from "@react-src/validators";
import { router } from "@inertiajs/react";
import route from "ziggy-js";


export default function SigninPage() {

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<SigninFields>({
        resolver: yupResolver(signinValidator),
        mode: "onSubmit",
        reValidateMode: "onSubmit",

    });



    const onSubmit = async (data: SigninFields) => {

        router.post(route("register"), data)

    }




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
                            Login
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
                <form onSubmit={handleSubmit(onSubmit)} className="w-full p-8 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" method='post' action="/account/postSignin">
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
                            {...register("password_confirmation")}
                            className={errors.password_confirmation ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.password_confirmation?.message}
                        </div>
                    </div>
                    <div className="flex flex-row space-x-2">
                        <button type="submit" className="btn-primary space-x-2">
                            <span>Crea account</span>
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
