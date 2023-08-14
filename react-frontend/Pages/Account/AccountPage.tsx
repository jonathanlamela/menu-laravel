import DashboardAdmin from "@react-src/pages/account/components/DashboardAdmin";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import HomeButton from "@react-src/components/HomeButton";
import HeaderMenu from "@react-src/components/HeaderMenu";
import DashboardDefault from "@react-src/pages/account/components/DashboardDefault";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import route from "ziggy-js"

export default function AccountPage() {
    return <>
        <BaseLayout title='Il mio account'>
            <Topbar>
                <TopbarLeft>
                    <HomeButton></HomeButton>
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
                        <BreadcrumbLink href={route('account.dashboard')}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Dashboard</li>
                </ol>
            </HeaderMenu>
            <div className="pl-8 pr-8 pt-8 flex flex-col space-y-4 pb-8">
                <Messages></Messages>
                <DashboardDefault></DashboardDefault>
                <DashboardAdmin></DashboardAdmin>
            </div>
        </BaseLayout>
    </>
}
