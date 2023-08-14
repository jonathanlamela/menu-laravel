import { Head, usePage } from '@inertiajs/react'
import { GeneralSettings } from '@react-src/types';

export default function BaseLayout({ title, children }: any) {
    const page = usePage<{ general_settings: GeneralSettings }>();
    const { general_settings }: { general_settings: GeneralSettings } = page.props;

    var site_name = title;

    if (general_settings.site_title) {
        site_name = `${title} :: ${(general_settings.site_title ?? "")}`
    }

    return <>
        <Head title={site_name}></Head>
        <main className="flex flex-col flex-grow">
            {children}
        </main>
    </>
}
