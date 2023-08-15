import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import HeaderMenu from "@react-src/components/HeaderMenu";
import { informazioniConsegnaValidator } from "@react-src/validators";
import { CartState, InformazioniConsegnaFields, Settings } from "@react-src/types";
import { Link, router, usePage } from "@inertiajs/react";
import route from "ziggy-js";


export default function InformazioniConsegnaPage() {

    const page = usePage<{ settings: Settings, cart: CartState }>();
    const { cart } = page.props;

    const { register, handleSubmit, formState: { errors } } = useForm<InformazioniConsegnaFields>({
        resolver: yupResolver(informazioniConsegnaValidator),
        defaultValues: {
            orario: cart.orario,
            indirizzo: cart.indirizzo
        }
    });


    const onSubmit = (data: InformazioniConsegnaFields) => {
        router.post(route("checkout.step2"), data);
    }

    return <>
        <BaseLayout title="Tipologia di consegna">

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
                    <BreadcrumbLink href={route("cart.show")}>
                        Carrello
                    </BreadcrumbLink>
                    <li>::</li>
                    <BreadcrumbLink href={route("checkout.step1")}>
                        1
                    </BreadcrumbLink>
                    <li>::</li>
                    <li>2. Informazioni consegna</li>
                </ol>
            </HeaderMenu>

            <div className="p-8">
                <div className="flex flex-col flex-grow space-y-4">
                    <div className="w-full md:w-1/2">
                        <Link href={route("checkout.step1")}><h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">1. Consegna ordine</h5></Link>
                    </div>
                    <div className="w-full md:w-1/2">
                        <form className="flex flex-col m-0 space-y-4" onSubmit={handleSubmit(onSubmit)}>
                            <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Indirizzo e orario</h5>
                            <p>Inserisci le informazioni di consegna</p>
                            <div className="flex flex-col space-y-2">
                                <label className="form-label">Indirizzo</label>
                                <input type="text"
                                    {...register("indirizzo")}
                                    className={errors.indirizzo ? "text-input-invalid" : "text-input"} />
                                <div className="invalid-feedback">
                                    {errors.indirizzo?.message}
                                </div>
                            </div>
                            <div className="flex flex-col space-y-2">
                                <label className="form-label">Orario</label>
                                <input type="text"
                                    {...register("orario")}
                                    className={errors.orario ? "text-input-invalid" : "text-input"} />
                                < div className="invalid-feedback">
                                    {errors.orario?.message}
                                </div>
                            </div>
                            <div className="w-full">
                                <button type="submit" className="btn-secondary-outlined">Vai</button>
                            </div>
                        </form>
                    </div>
                    <div className="w-full md:w-1/2">
                        <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
                    </div>
                </div>
            </div>
        </BaseLayout >
    </>
}
