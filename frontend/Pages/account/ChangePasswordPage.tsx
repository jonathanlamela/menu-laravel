import { useForm } from "react-hook-form";

import { yupResolver } from '@hookform/resolvers/yup';
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import ChangePasswordFields from "@src/types/ChangePasswordFields";
import changePasswordValidator from "@src/validators/changePasswordValidator";
import Messages from "@src/components/Messages";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";

import { useState } from "react";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import { Page } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/react";


export default function ChangePasswordPage() {
    const page = usePage<Page<{ user: any }>>();

    const { user } = page.props;


    const { register, handleSubmit, formState: { errors, isValid }, reset } = useForm<ChangePasswordFields>({
        resolver: yupResolver(changePasswordValidator),
        defaultValues: {
            email: user.email
        },
        reValidateMode: "onChange",
        mode: "onChange"
    });

    const [isPending, setIsPending] = useState(false);

    const onSubmit = async (data: ChangePasswordFields) => {

        //TODO




        reset()
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
                        <BreadcrumbLink href={route("account.dashboard")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Cambia password</li>
                </ol>
            </HeaderMenu>

            <div className="p-8">
                <Messages></Messages>
                <form className="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Password attuale</label>
                        <input type="password"
                            {...register("currentPassword")}
                            autoComplete="current-password"
                            className={"p-2 border border-gray-100" + (errors.currentPassword ? "border-red-600" : "")} />
                        <div className="invalid-feedback">
                            {errors.currentPassword?.message}
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
                            {...register("confirmPassword")}
                            className={"p-2 border border-gray-100" + (errors.confirmPassword ? "border-red-600" : "")} />
                        <div className="invalid-feedback">
                            {errors.confirmPassword?.message}
                        </div>
                    </div>

                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            <span>Cambia password</span>
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
