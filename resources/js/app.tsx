import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import React from "react"

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('/react-frontend/Pages/**/*.tsx', { eager: true });

    const pageToLoad = pages[`/react-frontend/Pages/${name}.tsx`];

    return pageToLoad;
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})
