import { Link, usePage } from '@inertiajs/react'
import React from "react"
import { GeneralSettings } from 'types';

export default function Header() {
    const page = usePage<{ general_settings: GeneralSettings }>();
    const { general_settings }: { general_settings: GeneralSettings } = page.props;


    return <>
        <div className="bg-red-900 p-8">
            <Link href={"/"} className="text-white text-center">
                <p className="text-4xl font-sans" style={{ fontFamily: "Smooch" }}>{general_settings.site_title}</p>
                <p className="font-sans">{general_settings.site_subtitle}</p>
            </Link>
        </div>
    </>
}
