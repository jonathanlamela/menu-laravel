import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import HomeButton from "@react-src/components/HomeButton";
import { CurrentUser, PersonalInfoFields } from "@react-src/types";
import { personalInfoValidator } from "@react-src/validators";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";


export default function InformazioniPersonaliPage() {
    const { user } = usePage<{ user: CurrentUser }>().props;

    console.log(user);
    const { register, handleSubmit, formState: { errors, isValid } } = useForm<PersonalInfoFields>({
        resolver: yupResolver(personalInfoValidator),
        defaultValues: {
            firstname: user.firstname,
            lastname: user.lastname
        }
    });

    const onSubmit = async (data: PersonalInfoFields) => {

        router.put(route('user-profile-information.update'), data)

    }


    return <>
        <BaseLayout title="Informazioni personali">
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
                        <BreadcrumbLink href={route("account.dashboard")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Informazioni personali</li>
                </ol>
            </HeaderMenu>

            <div className="px-8 py-4">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">Informazioni personali</p>
                </div>
                <form className="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Nome</label>
                        <input
                            type="text"
                            {...register("firstname")}
                            className={errors.firstname ? "text-input-invalid" : "text-input"}
                        />
                        <div className="invalid-feedback">{errors.firstname?.message}</div>
                    </div>
                    <div className="flex flex-col space-y-2">
                        <label className="form-label">Cognome</label>
                        <input
                            type="text"
                            {...register("lastname")}
                            className={errors.lastname ? "text-input-invalid" : "text-input"}
                        />
                        <div className="invalid-feedback">{errors.lastname?.message}</div>
                    </div>
                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <span>Aggiorna informazioni</span>
                        </button>
                    </div>
                </form>

            </div>
        </BaseLayout>
    </>
}
