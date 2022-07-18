import { usePage } from "@inertiajs/inertia-react"
import React from "react";
import CategoryNavList from "../components/CategoryNavList";
import FoodItem from "../components/FoodItem";
import Layout from "../components/Layout";

export default () => {

    const { category, foods } = usePage().props;
    return <>
        <Layout title={category.name} globalSearchEnabled={false} nav={<CategoryNavList></CategoryNavList>}>
            <div className="row g-0 p-4 flex-grow-1">
                <div className="col-lg-12">
                    <div className="row g-0">
                        {foods.data.map((item) => <FoodItem item={item} key={item.id}></FoodItem>)}
                    </div>

                    <div className="row g-0">
                        <div className="col-lg-3">

                        </div>
                    </div>
                    <div className="row g-0">

                    </div>
                </div>
            </div >
        </Layout>
    </>

}