import { usePage } from "@inertiajs/react";
import CategoryPill from "@src/components/CategoryPill";


export default function CategoryPills() {


    const page = usePage<{ categories: any }>();
    const { categories } = page.props;

    return <>
        <ul className="w-full md:flex flew-row md:space-x-2 items-center justify-center">
            {categories?.map((cat: any) => <CategoryPill item={cat} key={cat.id}></CategoryPill>)}
        </ul>
    </>
}
