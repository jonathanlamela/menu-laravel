import { Page } from "@inertiajs/inertia";
import { router, usePage } from "@inertiajs/react";
import { useState } from "react";
import route from "ziggy-js"

export default function SearchForm() {
    const page = usePage<Page<{ chiave?: string }>>();
    const { chiave } = page.props;

    const [value, setValue] = useState(chiave ?? "");

    const actionSearch = (e: any) => {
        e.preventDefault();
        router.get(route("searchGlobally"), {
            chiave: value
        });
    }
    return <>
        <form className="flex flex-row w-full md:w-96 space-x-2" onSubmit={((e) => actionSearch(e))}>
            <input type="text" name="chiave" className="p-2 w-3/4" onChange={(e) => setValue(e.target.value)} defaultValue={chiave} />
            <button type="submit" className="text-white w-1/4 p-2 border-white/25 border  hover:text-red-900 hover:bg-white" >Cerca</button>
        </form>
    </>;

}
