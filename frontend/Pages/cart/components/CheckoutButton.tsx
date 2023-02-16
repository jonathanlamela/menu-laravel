import { Page } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/react";

export default function CheckoutButton() {

    const page = usePage<Page<{ user: any }>>();
    var { user } = page.props;
    if (user) {
        return <>
            <Link className="bg-green-800 text-white p-4 hover:bg-green-900" href="/checkout/tipologia-consegna">Vai alla cassa</Link>
        </>
    } else {
        return null;
    }
}
