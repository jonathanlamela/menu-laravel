import AdminDeleteButton from "@react-src/pages/admin/components/AdminDeleteButton";
import AdminEditButton from "@react-src/pages/admin/components/AdminEditButton";
import route from "ziggy-js";

export default function AdminOrderRow({ item }: any) {
    return <>
        <tr className="h-10 w-full odd:bg-gray-100 flex-row flex flex-grow">
            <td className="w-1/12 flex items-center justify-center">{item.id}</td>
            <td className="w-5/12 lg:w-6/12 flex items-center text-clip">{item.user.firstname} {item.user.lastname}</td>
            <td className="hidden lg:flex lg:w-1/12 items-center justify-center">{item.orderState.name}</td>
            <td className="w-1/12 flex items-center justify-center">{item.total.toFixed(2)} €</td>
            <td
                className="w-3/12 flex flex-row space-x-2 items-center content-center justify-center">
                <AdminEditButton link={route("admin.order.edit", { id: item.id })}></AdminEditButton>
                <AdminDeleteButton link={route("admin.order.delete", { id: item.id })}></AdminDeleteButton>
            </td>
        </tr >
    </>
}


