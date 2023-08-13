import { ResetPasswordTokenFields } from "@src/types";
import { Resolver } from "react-hook-form";
import * as yup from "yup";

import route from "ziggy-js";

export const categoryValidator = yup.object({
    name: yup.string().required("Il campo nome è obbligatorio"),
    image: yup.mixed().test(
        "fileSize",
        "File troppo grande (max 1 mega)",
        (value: any) => {
            if (value && value.length === 0) {
                return true;
            }

            return value.length && value[0].size <= 1000 * 1000;
        },
    )
        .test(
            "fileFormat",
            "Formato non accettato",
            (value: any) => {
                if (value.length === 0) {
                    return true;
                }

                return value[0] &&
                    ["image/jpg", "image/jpeg", "image/png"].includes(
                        value[0].type,
                    );
            },
        ),
}).required();

export const changePasswordValidator = yup.object({
    email: yup.string().email("Inserisci un indirizzo email valido").required(
        "Questo campo è obbligatorio",
    ),
    current_password: yup.string().required("La password attuale è obbligatoria"),
    password: yup.string().matches(
        RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"),
        "La password deve essere lunga almeno 8 caratteri e contenere: 1 numero, 1 carattere speciale e una lettera maiuscola",
    ).required("Il campo password è obbligatorio"),
    password_confirmation: yup.string().required(
        "Il campo conferma password è obbligatorio",
    ).oneOf([yup.ref("password")], "Le due password devono corrispondere"),
}).required();

export const foodValidator = yup.object({
    name: yup.string().required("Il campo nome è obbligatorio"),
    price: yup.number().typeError("Inserisci un numero valido").required(
        "Il campo prezzo è obbligatorio",
    ).min(
        0.01,
        "Il prezzo deve essere maggiore di 0",
    ),
    categoryId: yup.number().required("La categoria è obbligatoria"),
}).required();

export const informazioniConsegnaValidator = yup.object({
    indirizzo: yup.string().required("L'indirizzo è obbligatorio"),
    orario: yup.string().required("L'orario è obbligatorio"),
});

export const loginValidator = yup.object({
    email: yup.string().email("Inserisci un indirizzo email valido").required(
        "Questo campo è obbligatorio",
    ),
    password: yup.string().required("Il campo password è obbligatorio"),
}).required();

export const orderStateValidator = yup.object({
    name: yup.string().required("Il campo nome è obbligatorio"),
});

export const personalInfoValidator = yup.object({
    firstname: yup.string().required("Il campo nome è obbligatorio"),
    lastname: yup.string().required("Il campo cognome è obbligatorio"),
}).required();



export const resetPasswordTokenValidator = yup.object({
    token: yup.string().required(
        "Questo campo è obbligatorio",
    ),
    password: yup.string().matches(
        RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"),
        "La password deve essere lunga almeno 8 caratteri e contenere: 1 numero, 1 carattere speciale e una lettera maiuscola",
    ).required("Il campo password è obbligatorio"),
    confirmPassword: yup.string().required(
        "Il campo conferma password è obbligatorio",
    ).oneOf([yup.ref("password")], "Le due password devono corrispondere"),
    email: yup.string().required()
}).required();

export const resetPasswordValidator = yup.object({
    email: yup.string().email("Inserisci un indirizzo email valido").required(
        "Questo campo è obbligatorio",
    ),
}).required();

export const settingValidator = yup.object({
    siteName: yup.string().required("Il campo nome del sito è obbligatorio"),
    shippingCosts: yup.number().typeError("Inserisci un numero valido").min(
        0.01,
        "Il prezzo deve essere maggiore di 0",
    ),
    orderCreatedStateId: yup.string().required("Seleziona uno stato valido"),
    orderPaidStateId: yup.string().required("Seleziona uno stato valido"),
});

const verifyEmail = async (value: string, values: yup.TestContext<any>) => {
    if (value.length > 0) {
        var response = await (await fetch(route("api.email_exists", { "email": value }))).json();


        if (response.result == true) {
            values.createError({ path: "email" });
        }

        return !response.result;
    } else {
        return false;
    }
};

export const signinValidator = yup.object({
    firstname: yup.string().required("Il campo nome è obbligatorio"),
    lastname: yup.string().required("Il campo cognome è obbligatorio"),
    email: yup.string().email("Inserisci un indirizzo email valido").required(
        "Questo campo è obbligatorio",
    ).test("is-busy", "Email in uso", async function (value, values) {
        const responseTest = await verifyEmail(value!, values);
        return responseTest as boolean;
    }),
    password: yup.string().matches(
        RegExp("^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$"),
        "La password deve essere lunga almeno 8 caratteri e contenere: 1 numero, 1 carattere speciale e una lettera maiuscola",
    ).required("Il campo password è obbligatorio"),
    password_confirmation: yup.string().required(
        "Il campo conferma password è obbligatorio",
    ).oneOf([yup.ref("password")], "Le due password devono corrispondere"),
});



export const tipologiaConsegnaValidator = yup.object({
    tipologiaConsegna: yup.string().required("La tipologia è obbligatoria"),
});

export const verifyAccountValidator = yup.object({
    email: yup.string().email("Inserisci un indirizzo email valido").required(
        "Questo campo è obbligatorio",
    ),
}).required();
