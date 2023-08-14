import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import FoodItemWithCategory from "@react-src/components/FoodItemWithCategory";
import Header from "@react-src/components/Header";
import SearchForm from "@react-src/components/SearchForm";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HeaderMenu from "@react-src/components/HeaderMenu";
import LoadingContent from "@react-src/components/LoadingContent";
import { usePage } from "@inertiajs/react";


export default function CercaPage() {

    const page = usePage<{ chiave: string, foods: any[] }>();

    const { chiave, foods } = page.props;

    console.log(foods);

    const searchResultsRender = () => {
        return foods.map((item: any) => <FoodItemWithCategory item={item} key={item.id}></FoodItemWithCategory>);
    }

    const content = () => {
        if (foods) {
            return <>
                <div className="flex flex-col p-8">
                    <div className="w-full pb-4">
                        <h4 className="font-bold text-lg">Risultati di ricerca per "{chiave}"</h4>
                    </div>
                    <div className="w-full space-y-4">
                        {foods.length === 0 ? <p>Nessun risultato trovato</p> : null}
                        {foods ? searchResultsRender() : null}
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
        <BaseLayout title={"Risultati di ricerca"}>

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
                <ol className="flex flex-row space-x-2 items-center pl-8 text-white h-16">
                    <li>
                        Home
                    </li>
                    <li>::</li>
                    <li>Ricerca</li>
                </ol>
            </HeaderMenu>

            {content()}
        </BaseLayout>
    </>
}
