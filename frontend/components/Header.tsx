import { Page } from "@inertiajs/inertia";
import { Link, usePage } from "@inertiajs/react";


export default function Header() {
    const page = usePage<Page<{ settings: any }>>();
    const { settings } = page.props;

    return <>
        <div className="bg-red-900 p-8">
            <Link href={"/"} className="text-white text-center">
                <p className="text-4xl font-sans" style={{ fontFamily: "Smooch" }}>{settings.site_name}</p>
                <p className="font-sans">{settings.site_subtitle}</p>
            </Link>
        </div>
    </>
}
