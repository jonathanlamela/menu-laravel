import { Head } from "@inertiajs/react";
import React from 'react'

export default function BaseLayout({ title, children }: any) {
    /*const appState = useAppSelector((state) => state.app);

    const { settings } = appState;*/

    var site_name = '';

    /*if (settings.site_name) {
        site_name = ` :: ${(settings.site_name ?? "")}`
    }*/

    return <>
        <Head>
            <title>{`${title}${site_name}`}</title>
        </Head>
        <main className="flex flex-col flex-grow">
            {children}
        </main>
    </>
}
