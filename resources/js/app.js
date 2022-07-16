import React from 'react'
import { createInertiaApp } from '@inertiajs/inertia-react'
import NProgress from 'nprogress'
import { Inertia } from '@inertiajs/inertia'
import ReactDOM from "react-dom/client";


createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props }) {
        //render(<App />, el)
        const root = ReactDOM.createRoot(el);
        root.render(

            <App  {...props} />

        );
    },
})

Inertia.on('start', () => NProgress.start())
Inertia.on('finish', () => NProgress.done())
