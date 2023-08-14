import { Link, usePage } from '@inertiajs/react'
import { Settings } from '@react-src/types';

export default function Header() {
    const page = usePage<{ settings: Settings }>();
    const { settings } = page.props;
    return <>
        <div className="bg-red-900 p-8">
            <Link href={"/"} className="text-white text-center">
                <p className="text-4xl font-sans" style={{ fontFamily: "Smooch" }}>{settings.site_title}</p>
                <p className="font-sans">{settings.site_subtitle}</p>
            </Link>
        </div>
    </>
}
