import { useForm } from "react-hook-form";

import { yupResolver } from '@hookform/resolvers/yup';
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
import { ChangePasswordFields, CurrentUser } from "@react-src/types";
import { changePasswordValidator } from "@react-src/validators";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";


export default function ChangePasswordPage() {
    const { user } = usePage<{ user: CurrentUser }>().props;


    const { register, handleSubmit, formState: { errors, isValid }, reset } = useForm<ChangePasswordFields>({
        resolver: yupResolver(changePasswordValidator),
        defaultValues: {
            email: user.email
        },
        reValidateMode: "onChange",
        mode: "onChange"
    });


    const onSubmit = async (data: ChangePasswordFields) => {

        router.put(route('user-password.update'), data, {
            onSuccess: () => {
                reset();
            }
        })
    }

    return <>
        <BaseLayout title="Cambia password">

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
                        <BreadcrumbLink href={route('account.dashboard')}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Cambia password</li>
                </ol>
            </HeaderMenu>

            <div className="px-8 py-4">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">Cambia password</p>
                </div>
                <form className="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Password attuale</label>
                        <input type="password"
                            {...register("current_password")}
                            autoComplete="current-password"
                            className={"p-2 border border-gray-100" + (errors.current_password ? "border-red-600" : "")} />
                        <div className="invalid-feedback">
                            {errors.current_password?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Nuova password</label>
                        <input type="password"
                            autoComplete="new-password"
                            {...register("password")}
                            className={"p-2 border border-gray-100" + (errors.password ? "border-red-600" : "")} />
                        <div className="invalid-feedback">
                            {errors.password?.message}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Conferma password</label>
                        <input type="password"
                            autoComplete="new-password"
                            {...register("password_confirmation")}
                            className={"p-2 border border-gray-100" + (errors.password_confirmation ? "border-red-600" : "")} />
                        <div className="invalid-feedback">
                            {errors.password_confirmation?.message}
                        </div>
                    </div>

                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <span>Cambia password</span>
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
