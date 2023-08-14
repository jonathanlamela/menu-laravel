import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useState } from "react";
import { useForm } from "react-hook-form";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import Messages from "@react-src/components/Messages";
import ButtonCircularProgress from "@react-src/components/ButtonCircularProgress";
import { CreateOrderStateFields } from "@react-src/types";
import route from "ziggy-js";
import { router } from "@inertiajs/react";
import { createOrderStateValidator } from "@react-src/validators";

export default function AdminOrderStateCreatePage() {

    const { register, handleSubmit, formState: { errors }, watch } = useForm<CreateOrderStateFields>({
        resolver: yupResolver(createOrderStateValidator)
    });
    const values = watch();

    const onSubmit = async (data: CreateOrderStateFields) => {
        router.post(route("admin.order-state.store"), data);
    }

    return <>
        <BaseLayout title="Crea stato">
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
                <ol className="flex h-16 flex-row space-x-2 items-center pl-8 text-white">
                    <li>
                        <BreadcrumbLink href="/amministrazione/stati-ordine">
                            Stati ordine
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Crea stato</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col p-8 flex-grow">
                <Messages></Messages>
                <form className="flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Nome</label>
                        <input type="text"
                            {...register("name")}
                            className={errors.name ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.name?.message}
                        </div>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">CSS Badge</label>
                        <select
                            {...register("css_badge_class")}
                            className={errors.css_badge_class ? "text-input-invalid" : "text-input"}>
                            <option value="badge-primary">Primary</option>
                            <option value="badge-secondary">Secondary</option>
                            <option value="badge-info">Info</option>
                            <option value="badge-success">Success</option>
                            <option value="badge-danger">Danger</option>
                        </select>
                        <div className="invalid-feedback">
                            {errors.css_badge_class?.message}
                        </div>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Preview</label>
                        <p className={values?.css_badge_class}>
                            Badge
                        </p>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2 items-start">
                        <button type="submit" className="btn-success">
                            Crea
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
