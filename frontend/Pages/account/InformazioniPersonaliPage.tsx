import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import PersonalInfoFields from "@src/types/PersonalInfoFields";
import personalInfoValidator from "@src/validators/personalInfoValidator";
import { useForm } from "react-hook-form";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import { useState } from "react";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import HomeButton from "@src/components/HomeButton";
import { usePage } from "@inertiajs/react";
import { Page } from "@inertiajs/inertia";


export default function LoginPage() {
    const page = usePage<Page<{ user: any }>>();
    const { user } = page.props;

    const { register, handleSubmit, formState: { errors, isValid } } = useForm<PersonalInfoFields>({
        resolver: yupResolver(personalInfoValidator),
        defaultValues: {
            firstname: user.firstname,
            lastname: user.lastname
        }
    });

    const [isPending, setIsPending] = useState(false);


    const onSubmit = async (data: PersonalInfoFields) => {

        setIsPending(true)

        //TODO

        setIsPending(false);
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
                        <BreadcrumbLink href="/account">
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Informazioni personali</li>
                </ol>
            </HeaderMenu>

            <div className="p-8">
                <Messages></Messages>
                <form className="w-full md:p-0 md:w-1/2 lg:w-1/3 flex flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
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
                    <div className="flex flex-row space-x-2">
                        <button disabled={!isValid} type="submit" className="btn-primary">
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            <span>Aggiorna informazioni</span>
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
