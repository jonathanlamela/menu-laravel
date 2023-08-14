import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import CartRow from "@react-src/pages/cart/components/CartRow";
import CategoryPills from "@react-src/components/CategoryPills";
import CheckoutButton from "@react-src/pages/cart/components/CheckoutButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";

import HeaderMenu from "@react-src/components/HeaderMenu";
import { CartRow as CartRowType, CartState } from "@react-src/types";
import { usePage } from "@inertiajs/react";


export default function CarrelloPage() {

    const page = usePage<{ cart: CartState }>();
    const cartState: CartState = page.props.cart;

    const { items, total } = cartState;


    const content = () => {
        if (Object.keys(items).length > 0) {
            return <>
                <div className="flex flex-col">
                    <div className="w-full">
                        <table className="flex flex-col">
                            <thead>
                                <tr className='flex'>
                                    <th className="w-3/6 text-left">Cibo</th>
                                    <th className="w-1/6 text-center">Quantità</th>
                                    <th className="w-1/6 text-center">Prezzo</th>
                                    <th className="w-1/6 text-center">Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
                                {Object.values(items).map((row: CartRowType) => <CartRow actionsVisible={true} row={row} key={row.item.id}></CartRow>)}
                            </tbody>
                            <tfoot>
                                <tr className='flex text-center pt-2'>
                                    <td className="w-3/6"></td>
                                    <td className="w-1/6 font-semibold">Totale</td>
                                    <td className="w-1/6">{total.toFixed(2)} €</td>
                                    <td className="w-1/6"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div className="w-full">
                        <CheckoutButton></CheckoutButton>
                    </div>
                </div>
            </>

        } else {
            return <>
                <p>Non ci sono elementi nel carrello</p>
            </>
        }
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
                <CategoryPills></CategoryPills>
            </HeaderMenu>
            <Messages></Messages>
            <div className="p-8">
                {content()}
            </div>
        </BaseLayout>
    </>
}
