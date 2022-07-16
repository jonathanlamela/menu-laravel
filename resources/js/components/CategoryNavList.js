import React from "react";
import { usePage } from '@inertiajs/inertia-react'
import CategoryNavItem from "./CategoryNavItem";

export default function CategoryNavList() {
    const { categories } = usePage().props

    return <>
        <div className="col-lg-12">
            <div className="row g-0  pt-2 pb-2  bg-secondary">
                <div className="col-lg-12 d-flex justify-content-center align-items-center ">
                    <div className="row g-0">
                        <div className="col-lg-12 d-flex justify-content-center align-items-center">
                            <ul className="nav flex-column flex-md-row category-pills">
                                {categories.map((item) => <CategoryNavItem item={item} key={item.id}></CategoryNavItem>)}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </>
}