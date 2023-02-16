import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import CartRow from "@src/pages/cart/components/CartRow";
import { useForm } from "react-hook-form";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import { Link, usePage } from "@inertiajs/inertia-react";
import { Page } from "@inertiajs/inertia";

export default function RiepilogoOrdinePage() {


    const page = usePage<Page<{ cart: any, settings: any }>>();

    const { tipoConsegna, indirizzo, orario, note, total, items } = page.props.cart;

    const { settings } = page.props;


    const shipping_row = {
        item: {
            id: 0,
            name: "Spese di consegna",
            price: settings.shipping_costs
        },
        quantity: 1
    }

    type RiepilogoOrdineFields = {
        note: string
    }

    const { register, handleSubmit, formState: { errors } } = useForm<RiepilogoOrdineFields>({
        defaultValues: {
            note: note
        }
    });


    const informazioniConsegna = () => {
        if (tipoConsegna !== "ASPORTO") {
            return <>

                <h6 className="uppercase font-semibold">Indirizzo e orario</h6>

                <table className="w-full">
                    <tr>
                        <td className="font-medium">Indirizzo</td>
                        <td>{orario}</td>
                    </tr>
                    <tr>
                        <td className="font-medium">Orario</td>
                        <td>{indirizzo}</td>
                    </tr>
                </table>

            </>
        } else {
            return <></>
        }
    }

    const onSubmit = (data: RiepilogoOrdineFields) => {
        // TODO: inviare ordine
    }

    const shipping_costs_row = () => {
        if (tipoConsegna !== "ASPORTO") {
            return <CartRow key={-1} row={shipping_row}></CartRow>
        }
        return null;
    }

    const subTotal = () => {
        return tipoConsegna !== "ASPORTO" ? total + parseFloat(settings.shipping_costs) : total;
    }

    const content = () => {
        return <>
            <div className="w-full md:w-1/2">
                <div className="flex flex-col space-y-4 pt-4">
                    <div className="w-full md:w-1/2">
                        <h6 className="uppercase font-semibold">Informazioni di consegna</h6>
                        {tipoConsegna === "ASPORTO" ? <p>Hai scelto di ritirare il tuo ordine (asporto)</p> : <p>Hai scelto la consegna a domicilio</p>}
                    </div>
                    <div className="w-full md:w-1/2">
                        {informazioniConsegna()}
                    </div>
                    <div className="w-full ">
                        <h6 className="uppercase font-semibold">Cosa c'è nel tuo ordine</h6>
                        <div className="p-4 bg-slate-100">
                            <table className="flex flex-col">
                                <thead>
                                    <tr className="flex border-b">
                                        <th className="w-4/6 text-left">Cibo</th>
                                        <th className="w-1/6 text-center">Quantità</th>
                                        <th className="w-1/6 text-center">Prezzo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {items.map((row: any) => <CartRow actionsVisible={false} row={row} key={row.item.id}></CartRow>)}
                                    {shipping_costs_row()}
                                </tbody>
                                <tfoot>
                                    <tr className="flex border-b py-2">
                                        <td className="w-4/6 text-left"></td>
                                        <td className="w-1/6 text-center font-bold">Totale</td>
                                        <td className="w-1/6 text-center">{subTotal().toFixed(2)} €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div className="w-full md:w-1/2">
                        <form className="flex flex-col m-0" onSubmit={handleSubmit(onSubmit)}>
                            <div className="flex flex-col py-2">
                                <label className="form-label">Note</label>
                                <textarea {...register("note")}
                                    className="text-input"></textarea>
                            </div>
                            <div className="flex flex-col py-2 items-start">
                                <button type="submit" className="btn-success">Invia ordine</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div >



        </>
    }



    const getBreadcrumb = () => {

        if (tipoConsegna === "DOMICILIO") {
            return <>
                <BreadcrumbLink href="/carrello">
                    Carrello
                </BreadcrumbLink>
                <li>::</li>
                <BreadcrumbLink href="/checkout/tipologia-consegna">
                    1
                </BreadcrumbLink>
                <li>::</li>
                <BreadcrumbLink href="/checkout/informazioni-consegna">
                    2
                </BreadcrumbLink>
                <li>::</li>
                <li>3. Riepilogo</li>
            </>
        }

        return <>
            <BreadcrumbLink href="/carrello">
                Carrello
            </BreadcrumbLink>
            <li>::</li>
            <BreadcrumbLink href="/checkout/tipologia-consegna">
                1
            </BreadcrumbLink>
            <li>::</li>
            <li>2. Riepilogo</li>
        </>
    }

    const sectionLinks = () => {

        if (tipoConsegna === "DOMICILIO") {
            return <>
                <div className="w-full md:w-1/2">
                    <Link href="/checkout/tipologia-consegna">
                        <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">1. Consegna ordine</h5>
                    </Link>
                </div>
                <div className="w-full md:w-1/2">
                    <Link href="/checkout/informazioni-consegna">
                        <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Informazioni consegna</h5>
                    </Link>
                </div>
                <div className="w-full md:w-1/2">
                    <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">3. Riepilogo</h5>
                </div>
            </>
        }

        return <>
            <div className="w-full md:w-1/2">
                <Link href="/checkout/tipologia-consegna">
                    <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">1. Consegna ordine</h5>
                </Link>
            </div>
            <div className="w-full md:w-1/2">
                <h5 className="font-semibold text-lg border-b-slate-300 border-b-2 pb-2">2. Riepilogo</h5>
            </div>

        </>
    }

    return <>
        <BaseLayout title="Carrello">

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
                    {getBreadcrumb()}
                </ol>
            </HeaderMenu>

            <div className="p-8">
                <div className="flex flex-col flex-grow space-y-4">
                    {sectionLinks()}
                    {content()}
                </div>
            </div>

        </BaseLayout>
    </>
}
