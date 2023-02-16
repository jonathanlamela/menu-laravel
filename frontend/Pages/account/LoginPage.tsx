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
import loginValidator from "@src/validators/loginValidator";
import LoginFields from "@src/types/LoginFields";
import { useState } from "react";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import HomeButton from "@src/components/HomeButton";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import { Link, usePage } from "@inertiajs/react";
import { Page } from "@inertiajs/inertia";
import route from "ziggy-js"
import { router } from '@inertiajs/react'

export default function LoginPage() {

    const page = usePage<Page<{ backUrl: any, errors?: any }>>();



    const { backUrl } = page.props;

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<LoginFields>({
        resolver: yupResolver(loginValidator)
    });

    const [isPending, setIsPending] = useState(false);

    const onSubmit = async (data: LoginFields) => {

        setIsPending(true);

        //TODO
        router.post(page.url, data);


        setIsPending(false);
    }

    const emailErrors = () => {
        if (page.props.errors.email) {
            return page.props.errors.email
        }
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
                        Profilo
                    </li>
                    <li>::</li>
                    <li>Accedi</li>
                </ol>
            </HeaderMenu>
            <div className="px-8 pt-8">
                <Messages></Messages>
            </div>
            <div className='flex flex-grow flex-col justify-center items-center'>

                <form className="w-full p-16 md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    {backUrl ? <input type="hidden" {...register("backUrl")} name="backUrl" value={backUrl} /> : null}
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Email</label>
                        <input type="text"
                            {...register("email")}
                            className={errors.email ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.email?.message}
                            {emailErrors()}
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
                    <div className="flex flex-col space-y-0.5">
                        <Link href={route("password.request")} className="hover:text-red-900">
                            Ho dimenticato la password
                        </Link>
                    </div>
                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            Accedi
                        </button>
                        <Link href={route("register")} className="btn-secondary-outlined">
                            Crea account
                        </Link>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}


