import { Link, usePage } from "@inertiajs/react";
import route from "ziggy-js"

export default function CheckoutButton() {

    const page = usePage();

    var { user } = page.props;
    if (user) {
        return <>
            <Link className="bg-green-800 text-white p-4 hover:bg-green-900" href={route("checkout.step1")}>Vai alla cassa</Link>
        </>
    } else {
        return null;
    }
}
