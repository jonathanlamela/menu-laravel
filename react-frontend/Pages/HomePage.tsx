import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import CategoryPills from "@react-src/components/CategoryPills";
import Header from "@react-src/components/Header";
import HeaderMenu from "@react-src/components/HeaderMenu";
import SearchForm from "@react-src/components/SearchForm";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";


export default function HomePage() {

    return <>
        <BaseLayout title="Homepage">
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
        </BaseLayout>
    </>
}
