import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@react-src/components/AccountManage";
import CartButton from "@react-src/components/CartButton";
import Header from "@react-src/components/Header";
import HomeButton from "@react-src/components/HomeButton";
import Topbar from "@react-src/components/Topbar";
import TopbarLeft from "@react-src/components/TopbarLeft";
import TopbarRight from "@react-src/components/TopbarRight";
import BaseLayout from "@react-src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import HeaderMenu from "@react-src/components/HeaderMenu";
import BreadcrumbLink from "@react-src/components/BreadcrumbLink";
import Messages from "@react-src/components/Messages";
import { Category, CreateFoodFields } from "@react-src/types";
import { createFoodValidator } from "@react-src/validators";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";


export default function AdminCategoryFoodPage() {

    const page = usePage<{ categories: Category[] }>();
    const { categories } = page.props;
    const { register, handleSubmit, formState: { errors } } = useForm<CreateFoodFields>({
        resolver: yupResolver(createFoodValidator)
    });

    const onSubmit = async (data: CreateFoodFields) => {
        router.post(route("admin.food.store"), data);
    }


    return <>
        <BaseLayout title="Crea cibo">
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
                <ol className="flex h-16 flex-row space-x-2 items-center pl-8 text-white">
                    <li>
                        <BreadcrumbLink href={route("admin.food.list")}>
                            Cibi
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Crea cibo</li>
                </ol>
            </HeaderMenu>

            <div className="flex flex-col p-8 flex-grow">
                <Messages></Messages>
                <form className="flex-col space-y-2" onSubmit={handleSubmit(onSubmit)}>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Nome</label>
                        <input type="text"
                            {...register("name")}
                            className={errors.name ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.name?.message}
                        </div>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Ingredienti</label>
                        <textarea className="text-input" {...register("ingredients")}></textarea>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Prezzo</label>
                        <input type="text"
                            {...register("price")}
                            className={errors.price ? "text-input-invalid" : "text-input"} />
                        <div className="invalid-feedback">
                            {errors.price?.message}
                        </div>
                    </div>
                    <div className="w-1/3 flex flex-col space-y-2">
                        <label className="form-label">Categoria</label>
                        <select {...register("category_id")}
                            className={errors.category_id ? "text-input-invalid" : "text-input"}>
                            {categories.map((cat: any) => <option key={cat.id} value={cat.id}>{cat.name}</option>)}
                        </select>
                        <div className="invalid-feedback">
                            {errors.category_id?.message}
                        </div>
                    </div>

                    <div className="w-1/3 flex flex-col space-y-2 items-start">
                        <button type="submit" className="btn-success">
                            Crea
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
