import { useForm } from "react-hook-form";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Messages from "@react-src/components/Messages";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import AdminPagination from "@react-src/pages/admin/components/AdminPagination";
import AdminPerPage from "@react-src/pages/admin/components/AdminPerPage";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import AdminOrderToggler from "@react-src/pages/admin/components/AdminOrderToggler";
import { SearchFields } from "@react-src/types";
import { Link, router, usePage } from "@inertiajs/react";
import route from "ziggy-js";
import AdminOrderRow from "@react-src/pages/admin/order/components/AdminOrderRow";

export default function AdminOrderListPage() {


    const page = usePage<{ data: any, search: string, ascending: boolean, orderBy: string, perPage: number }>();
    const { search, ascending, orderBy, data } = page.props;
    var items: any[] = data.data;

    const { register, handleSubmit, } = useForm<SearchFields>({
        defaultValues: {
            search: search ?? ""
        }
    });

    const onSubmit = async (formData: SearchFields) => {
        router.visit(route("admin.order.list"), {
            data: {
                search: formData.search,
                page: data.current_page,
                orderBy: orderBy,
                ascending: ascending,
                perPage: data.per_page
            }
        })
    }

    const toggleOrder = (by: string) => {

        if (by === orderBy) {

            router.visit(route("admin.order.list"), {
                data: {
                    search: search,
                    page: data.current_page,
                    orderBy: by,
                    ascending: !ascending,
                    perPage: data.per_page
                }
            })
        } else {
            router.visit(route("admin.order.list"), {
                data: {
                    search: search,
                    page: data.current_page,
                    orderBy: by,
                    ascending: true,
                    perPage: data.per_page
                }
            })
        }
    }

    const goToPage = (page: number) => {
        router.visit(route("admin.order.list"), {
            data: {
                search: search,
                page: page,
                orderBy: orderBy,
                ascending: ascending,
                perPage: data.per_page
            }
        })
    }

    const editPerPage = (value: number) => {
        router.visit(route("admin.order.list"), {
            data: {
                search: search,
                page: data.current_page,
                orderBy: orderBy,
                ascending: ascending,
                perPage: value
            }
        })
    }

    return <>
        <BaseLayout title="Ordini">
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
                        <BreadcrumbLink href={route("account.index")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Amministrazione ordini</li>
                </ol>
            </HeaderMenu>
            <div className="flex flex-col px-8 py-4 flex-grow">
                <Messages></Messages>
                <div className="w-full pb-4">
                    <p className="text-2xl antialiased font-bold">Ordini</p>
                </div>
                <div className="flex w-full bg-gray-100 p-2">
                    <div className="w-full flex justify-end">
                        <form className="m-0 flex space-x-2" onSubmit={handleSubmit(onSubmit)}>
                            <input {...register("search")} type="text" className="text-input bg-white" name="search" placeholder="Cerca un ordine"
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
                    <table className="w-full flex flex-col">
                        <thead>
                            <tr className="h-10 flex flex-row items-center">
                                <th className="w-1/12">
                                    <AdminOrderToggler
                                        className="flex w-full flex-row space-x-1 justify-center"
                                        ascending={ascending}
                                        isCurrent={orderBy === "id"}
                                        label="Id" onClick={() => {
                                            toggleOrder("id")
                                        }}></AdminOrderToggler></th>
                                <th className="w-5/12 lg:w-6/12">
                                    <AdminOrderToggler
                                        className="flex w-full flex-row space-x-1 justify-start"
                                        ascending={ascending}
                                        isCurrent={orderBy === "user"}
                                        label="Utente" onClick={() => {
                                            toggleOrder("user")
                                        }}></AdminOrderToggler>
                                </th>
                                <th className="hidden lg:flex lg:w-1/12 items-center justify-start">
                                    <AdminOrderToggler
                                        className="flex w-full flex-row space-x-1 justify-center"
                                        ascending={ascending}
                                        isCurrent={orderBy === "order_state_id"}
                                        label="Stato ordine" onClick={() => {
                                            toggleOrder("order_state_id")
                                        }}></AdminOrderToggler>
                                </th>
                                <th className="w-1/12">
                                    <AdminOrderToggler
                                        className="flex w-full flex-row space-x-1 justify-center"
                                        ascending={ascending}
                                        isCurrent={orderBy === "total"}
                                        label="Totale" onClick={() => {
                                            toggleOrder("total")
                                        }}></AdminOrderToggler>
                                </th>
                                <th className="w-3/12 text-center">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            {items?.map((row: any) => <AdminOrderRow item={row} key={row.id}></AdminOrderRow>)}
                        </tbody>
                    </table>
                </div>
                <div className="w-full flex px-4 py-4">
                    <AdminPerPage currentValue={data.per_page} onChangeHandler={(value: number) => {
                        editPerPage(value)
                    }}></AdminPerPage>
                </div>
                <div className="w-full flex px-4 py-4 bg-gray-100">
                    <AdminPagination currentValue={data.current_page} pagesCount={data.last_page} onChangeHandler={(value: number) => { goToPage(value) }} ></AdminPagination>
                </div>
            </div>
        </BaseLayout>
    </>
}
