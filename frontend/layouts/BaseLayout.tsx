import { Page } from "@inertiajs/inertia";
import { Head, usePage } from "@inertiajs/react";

export default function BaseLayout({ title, children }: any) {

    var site_name = '';

    const page = usePage<Page<{ settings: any }>>();
    const { settings } = page.props;

    if (settings.site_name) {
        site_name = ` :: ${(settings.site_name ?? "")}`
    }

    return <>
        <Head>
            <title>{`${title}${site_name}`}</title>
        </Head>
        <main className="flex flex-col flex-grow">
            {children}
        </main>
    </>
}
