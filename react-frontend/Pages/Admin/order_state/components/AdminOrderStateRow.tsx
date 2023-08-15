import AdminDeleteButton from "@react-src/pages/admin/components/AdminDeleteButton";
import AdminEditButton from "@react-src/pages/admin/components/AdminEditButton";
import route from "ziggy-js";


export default function AdminOrderStateRow({ item }: any) {
    return <>
        <tr className="h-10 w-full odd:bg-gray-100 flex-row flex flex-grow">
            <td className="w-1/12 text-center flex items-center justify-center">{item.id}</td>
            <td className="w-6/12 md:w-5/12 text-left flex items-center">{item.name}</td>
            <td className="w-2/12 text-center hidden lg:flex items-center justify-center"><span className={item.css_badge_class}>Esempio di testo</span></td>
            <td className="w-5/12 md:w-4/12 text-center flex flex-row space-x-2 items-center content-center justify-center">
                <AdminEditButton link={route("admin.order-state.edit", { orderState: item.id })} />
                <AdminDeleteButton link={route("admin.order-state.delete", { orderState: item.id })} />
            </td>
        </tr >
    </>
}


