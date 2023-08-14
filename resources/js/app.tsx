/// <reference types="vite/client" />
import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import React from "react"

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('/react-frontend/pages/**/*.tsx', { eager: true });

    const pageToLoad = pages[`/react-frontend/pages/${name}.tsx`];

    return pageToLoad;
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})
