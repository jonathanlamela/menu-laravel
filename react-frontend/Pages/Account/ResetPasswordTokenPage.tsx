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

import HomeButton from "@src/components/HomeButton";

import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";

import { ResetPasswordTokenFields } from "@src/types";
import { router, usePage } from "@inertiajs/react";
import { resetPasswordTokenValidator } from "@src/validators";
import route from "ziggy-js";

export default function ResetPasswordTokenPage() {

    const page = usePage<{ token: string; email: string }>();
    const { token } = page.props;

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<ResetPasswordTokenFields>({
        resolver: yupResolver(resetPasswordTokenValidator),
        defaultValues: {
            token: token!,
        },
        mode: "onChange",
        reValidateMode: "onChange"
    });


    const onSubmit = async (data: ResetPasswordTokenFields) => {

        router.post(route("password.update"), {
            token: data.token,
            email: data.email,
            password: data.password,
            password_confirmation: data.confirmPassword
        })
    }


    return <>
        <BaseLayout title='Recupera password'>
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
                    <li>Reset password</li>
                </ol>
            </HeaderMenu>
            <div className="p-8">
                <Messages></Messages>
                <form className="w-full md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <input type="hidden"
                        {...register("token")}
                    />

                    <div className="flex flex-col space-y-2">
                        <p className='font-semibold text-lg antialiased'>Compila il form per cambiare la tua password</p>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Email</label>
                        <input type="email"
                            {...register("email")}
                            className={"p-2 border border-gray-100" + (errors.email ? "form-control is-invalid" : "")} />
                        <div className="invalid-feedback">
                            {errors.email?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Password</label>
                        <input type="password"
                            {...register("password")}
                            className={"p-2 border border-gray-100" + (errors.password ? "form-control is-invalid" : "")} />
                        <div className="invalid-feedback">
                            {errors.password?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Conferma password</label>
                        <input type="password"
                            {...register("confirmPassword")}
                            className={"p-2 border border-gray-100" + (errors.confirmPassword ? "form-control is-invalid" : "")} />
                        <div className="invalid-feedback">
                            {errors.confirmPassword?.message}
                        </div>
                    </div>
                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <span>Reset password</span>
                        </button>
                    </div>
                </form>
            </div>

        </BaseLayout>
    </>
}


