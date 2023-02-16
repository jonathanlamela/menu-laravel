import { yupResolver } from "@hookform/resolvers/yup";
import { useState } from "react";
import AccountManage from "@src/components/AccountManage";
import CartButton from "@src/components/CartButton";
import Header from "@src/components/Header";
import HomeButton from "@src/components/HomeButton";
import Messages from "@src/components/Messages";
import Topbar from "@src/components/Topbar";
import TopbarLeft from "@src/components/TopbarLeft";
import TopbarRight from "@src/components/TopbarRight";
import BaseLayout from "@src/layouts/BaseLayout";
import CategoryFields from "@src/types/CategoryFields";
import categoryValidator from "@src/validators/categoryValidator";
import { useForm } from "react-hook-form";

import HeaderMenu from "@src/components/HeaderMenu";
import BreadcrumbLink from "@src/components/BreadcrumbLink";
import ButtonCircularProgress from "@src/components/ButtonCircularProgress";
import { Page } from "@inertiajs/inertia";
import { usePage } from "@inertiajs/react";


export default function AdminCategoryEditPage() {

    const page = usePage<Page<{ item: any }>>();
    const { item } = page.props;

    const [isPending, setIsPending] = useState(false);

    const { register, handleSubmit, formState: { errors }, setValue } = useForm<CategoryFields>({
        resolver: yupResolver(categoryValidator),
        defaultValues: item
    });


    const onSubmit = async (data: CategoryFields) => {

        setIsPending(true);

        //TODO
        setIsPending(false);

    }

    const currentImage = () => {
        if (item && item.image_url) {
            return <>
                <div className="w-1/3 flex flex-col space-y-2">
                    <label className="form-label">Immagine attuale</label>
                    <img src={`/${item.image_url}`} alt={"Immagine categoria " + item.name} height="100" />
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
                        <BreadcrumbLink href="/amministrazione/categorie">
                            Categorie
                        </BreadcrumbLink>
                    </li>
                    <li>::</li>
                    <li>Crea categoria</li>
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
                            <ButtonCircularProgress isPending={isPending}></ButtonCircularProgress>
                            Aggiorna
                        </button>
                    </div>
                </form>
            </div>
        </BaseLayout>
    </>
}
