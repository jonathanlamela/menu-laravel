import { usePage } from "@inertiajs/react";
import CategoryPill from "@react-src/components/CategoryPill";


export default function CategoryPills() {


    const page = usePage<{ categories_for_pills: any }>();
    const { categories_for_pills } = page.props;

    return <>
        <ul className="w-full md:flex flew-row md:space-x-2 items-center justify-center">
            {categories_for_pills?.map((cat: any) => <CategoryPill item={cat} key={cat.id}></CategoryPill>)}
        </ul>
    </>
}
