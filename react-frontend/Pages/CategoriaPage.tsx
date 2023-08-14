import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import CategoryPills from "@react-src/components/CategoryPills";
import FoodItem from "@react-src/components/FoodItem";
import Header from "@react-src/components/Header";
import SearchForm from "@react-src/components/SearchForm";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HeaderMenu from "@react-src/components/HeaderMenu";
import LoadingContent from "@react-src/components/LoadingContent";
import { usePage } from "@inertiajs/react";

export default function CategoriaPage() {


    const page = usePage<{ category: any, foods: [] }>();

    const { category, foods } = page.props;

    const { name } = category ?? { name: "" };

    const foodsRender = () => {
        return foods.map((item: any) => <FoodItem item={item} key={item.id}></FoodItem>);
    }

    const content = () => {

        if (category && foods) {
            return <>
                <div className="flex flex-col p-8">
                    <div className="w-full pb-4">
                        <h4 className="font-bold text-lg">Categoria {category.name.toLowerCase()}</h4>
                    </div>
                    <div className="w-full space-y-4">
                        {foods.length === 0 ? <p>Non ci sono cibi per questa categoria</p> : null}
                        {foods ? foodsRender() : null}
                    </div>
                </div>
            </>
        } else {
            return <>
                <LoadingContent></LoadingContent>
            </>
        }
    }

    return <>

        <BaseLayout title={name || "Categoria"}>
            <Topbar>
                <TopbarLeft>
                    <SearchForm></SearchForm>
                </TopbarLeft>
                <TopbarRight>
                    <CartButton></CartButton>
                    <AccountManage></AccountManage>
                </TopbarRight>
            </Topbar>
            <Header></Header>
            <HeaderMenu>
                <CategoryPills></CategoryPills>
            </HeaderMenu>
            {content()}
        </BaseLayout>
    </>

}
