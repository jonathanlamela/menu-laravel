import { yupResolver } from "@hookform/resolvers/yup";
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import { useForm } from "react-hook-form";
import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import { Category, UpdateCategoryFields } from "@src/types";
import { router, usePage } from "@inertiajs/react";
import route from "ziggy-js";
import { updateCategoryValidator } from "@src/validators";


export default function AdminCategoryEditPage() {

    const page = usePage<{ category: Category }>();
    const { category } = page.props;

    const { register, handleSubmit, formState: { errors } } = useForm<UpdateCategoryFields>({
        resolver: yupResolver(updateCategoryValidator),
        defaultValues: {
            id: category.id,
            name: category.name,
            image: category.image
        }
    });


    const onSubmit = async (data: UpdateCategoryFields) => {
        router.post(route("admin.category.update", { category: category }), {
            name: data.name,
            image: data.image ? data.image[0] : null
        }, {
            forceFormData: true
        });
    }

    const currentImage = () => {
        if (category && category.image) {
            return <>
                <div className="w-1/3 flex flex-col space-y-2">
                    <label className="form-label">Immagine attuale</label>
                    <img src={`${category.image}`} alt={"Immagine categoria " + category.name} height="100" />
                </div>
            </>
        }
        return null;
    }


    return <>
        <BaseLayout title="Modifica categoria">
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
                        <BreadcrumbLink href={route("account.dashboard")}>
                            Profilo
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>
                        <BreadcrumbLink href={route("admin.category.list")}>
                            Categorie
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Modifica categoria</li>
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
                        <label className="form-label">Immagine</label>
                        <input type="file"
                            {...register("image")}
                        />
                        <div className="invalid-feedback">
                            {errors.image?.message}
                        </div>
                    </div>
                    {currentImage()}
                    <div className="w-1/3 flex flex-col space-y-2 items-start">
                        <button type="submit" className="btn-success ">
                            Aggiorna
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
