import React from "react";
import { usePage } from '@inertiajs/inertia-react'
import { Link } from '@inertiajs/inertia-react'


export default function CategoryNavItem({ item }) {
    const { url } = usePage()
    var classes = "nav-link nav-pill-item me-2 rounded-4 text-dark my-1 my-sm-0";

    if (route("category.show", item.slug).endsWith(url)) {
        classes = "nav-link nav-pill-item me-2 rounded-4 text-light active";
    }

    return <>
        <li className="nav-item">
            <Link className={classes} href={route('category.show', { 'category': item.slug })}>{item.name}</Link>
        </li>
    </>
}