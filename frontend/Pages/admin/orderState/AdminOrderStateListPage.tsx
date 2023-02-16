import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";

import { useState, } from "react";
import { useForm } from "react-hook-form";
import OrderStateFields from "@src/types/admin/OrderStateFields";
import SearchFields from "@src/types/admin/SearchFields";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import LoadingContent from "@src/components/LoadingContent";
import { Link, usePage } from "@inertiajs/react";
import { Page } from "@inertiajs/inertia";
import AdminOrderToggler from "@src/Pages/admin/components/AdminOrderToggler";
import AdminOrderStateRow from "@src/Pages/admin/orderState/components/AdminOrderStateRow";
import AdminPerPage from "@src/Pages/admin/components/AdminPerPage";
import AdminPagination from "@src/Pages/admin/components/AdminPagination";

export default function AdminOrderStateListPage() {
    const pageData = usePage<Page<{ perPage: number, page: number, ascending: boolean, searchKey: string, orderStates: any[], count: number, orderBy: string }>>();

    const [isPending, setIsPending] = useState(false);

    const { ascending, orderStates, count, page, perPage, searchKey, orderBy } = pageData.props;

    const { register, handleSubmit, } = useForm<SearchFields>({
        defaultValues: {
            search: searchKey ?? ""
        }
    });

    const setPerPage = (value: number) => {

    }

    const setPage = (value: number) => {

    }

    const onSubmit = async (data: SearchFields) => {
        //TODO
    }
    const toggleOrder = (by: string) => {
        if (by === orderBy) {
            //TODO
        } else {
            //todo
        }
    }

    const content = () => {

        if (!isPending) {
            return <>
                <table className="w-full flex flex-col">
                    <thead>
                        <tr className="h-10 flex flex-row items-center">
                            <th className="w-1/12 text-center">
                                <AdminOrderToggler
                                    className="flex w-full flex-row space-x-1 justify-center"
                                    ascending={ascending}
                                    isCurrent={orderBy === "id"}
                                    label="Id" onClick={() => {
                                        toggleOrder("id")
                                    }}></AdminOrderToggler>
                            </th>
                            <th className="w-6/12 md:w-5/12 text-left">
                                <AdminOrderToggler
                                    ascending={ascending}
                                    className="flex w-full flex-row space-x-1 justify-start"
                                    isCurrent={orderBy === "name"}
                                    label="Nome" onClick={() => {
                                        toggleOrder("name")
                                    }}></AdminOrderToggler>
                            </th>
                            <th className="w-2/12 text-center hidden lg:block">Classe CSS Badge</th>
                            <th className="w-6/12 md:w-4/12 text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        {orderStates?.map((row: OrderStateFields) => <AdminOrderStateRow key={row.id} item={row}></AdminOrderStateRow>)}
                    </tbody>
                </table>
            </>
        } else {
            return <>
                <LoadingContent></LoadingContent>
            </>
        }
    }

    return <>

        <BaseLayout title="Stati ordine">

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
                <ol className="flex flex-row space-x-2 items-center h-16 pl-8 text-white">
                    <li>
                        <BreadcrumbLink href="/account">
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Amministrazione stati ordine</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col p-8 flex-grow">
                <Messages></Messages>
                <div className="w-full bg-slate-500 p-4">
                    <p className="text-xl antialiased text-white">Stati ordine</p>
                </div>
                <div className="flex w-full bg-gray-100 p-2">
                    <div className="w-1/2">
                        <div className="flex">
                            <Link href="/amministrazione/stati-ordine/crea" className="btn-primary">Crea</Link>
                        </div>
                    </div>
                    <div className="w-1/2 flex justify-end">
                        <form className="m-0 flex space-x-2" onSubmit={handleSubmit(onSubmit)}>
                            <input {...register("search")} type="text" className="text-input bg-white" name="search" placeholder="Cerca uno stato"
                            />
                            <button type="submit" className="btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth="1.5"
                                    stroke="currentColor" className="w-6 h-6">
                                    <path strokeLinecap="round" strokeLinejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div className="flex w-full flex-grow">
                    {content()}
                </div>
                <div className="w-full flex px-4 py-4">
                    <AdminPerPage currentValue={perPage} onChangeHandler={(value: number) => { setPerPage(value); setPage(1) }}></AdminPerPage>
                </div>
                <div className="w-full flex px-4 py-4 bg-gray-100">
                    <AdminPagination currentValue={page} onChangeHandler={(value: number) => setPage(value)} itemsCount={count} perPage={perPage}></AdminPagination>
                </div>
            </div>
        </BaseLayout>
    </>

}
