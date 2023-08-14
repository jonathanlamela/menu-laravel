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

import HomeButton from "@react-src/components/HomeButton";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import { ResetPasswordFields } from "@react-src/types";
import { resetPasswordValidator } from "@react-src/validators";
import { router } from "@inertiajs/react";

import route from "ziggy-js"

export default function ResetPasswordPage() {


    const { register, handleSubmit, formState: { errors, isValid } } = useForm<ResetPasswordFields>({
        resolver: yupResolver(resetPasswordValidator),
        mode: "onChange"
    });



    const onSubmit = async (data: ResetPasswordFields) => {
        router.post(route('password.email'), {
            email: data.email
        });
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
                            Login
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Reset password</li>
                </ol>
            </HeaderMenu>

            <div className='p-8'>
                <Messages></Messages>
                <form className="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>

                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Email</label>
                        <input type="text"
                            {...register("email")}
                            className={errors.email ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.email?.message}
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


