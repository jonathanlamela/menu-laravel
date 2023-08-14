import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import SearchForm from "@react-src/components/SearchForm";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";


export default function Error403Page() {

    return <>
        <BaseLayout title="Accesso negato">
            <Topbar>
                <TopbarLeft>
                    <HomeButton />
                </TopbarLeft>
                <TopbarRight>

                </TopbarRight>
            </Topbar>
            <Header></Header>
            <Header></Header>
            <div className="flex items-center justify-center flex-grow">
                <div className="flex flex-col items-center space-y-4">
                    <div className="flex flex-col items-center space-y-4 animate-bounce">
                        <span className="text-3xl">403</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-12 h-12">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>

                    </div>
                    <p>Non hai i permessi per vedere questa sezione</p>
                </div>
            </div>
        </BaseLayout>
    </>
}
