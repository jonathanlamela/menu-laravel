export type CartItem = {
  id: number;
  name?: string;
  price?: number;
};

export type CartRow = {
  item: CartItem;
  quantity: number;
};

export type CategoryFields = {
  name: string;
  image: FileList;
};

export type CreateCategoryFields = CategoryFields;
export type UpdateCategoryFields = CategoryFields & {
  id: number;
};

export type ChangePasswordFields = {
  email: string;
  current_password: string;
  password: string;
  password_confirmation: string;
};

export type LoginFields = {
  email: string;
  password: string;
  backUrl?: string;
};

export type PersonalInfoFields = {
  firstname: string;
  lastname: string;
};

export type ResetPasswordFields = {
  email: string;
};

export type ResetPasswordTokenFields = {
  token: string;
  password: string;
  confirmPassword: string;
  email: string;
};

export type SigninFields = {
  email: string;
  password: string;
  password_confirmation: string;
  firstname: string;
  lastname: string;
};

export type VerifyAccountFields = {
  email: string;
};

export type SearchFields = {
  search: string;
};

export interface OrderStateFields {
  id: number;
  name: string;
  cssBadgeClass?: string;
}

export type FoodFields = {
  id: number;
  name: string;
  ingredients: string;
  price: number;
  categoryId: number;
};

export type Category = {
  id: number;
  name: string;
  image: FileList;
};

export type InformazioniConsegnaFields = {
  orario: string;
  indirizzo: string;
};

export type RiepilogoOrdineFields = {
  note: string;
};

export enum TipologiaConsegna {
  ASPORTO = "ASPORTO",
  DOMICILIO = "DOMICILIO",
}

export type TipologiaConsegnaFields = {
  tipologiaConsegna: TipologiaConsegna;
};

export enum AccountSigninStatus {
  none,
  pending,
  failed,
  success,
}

export enum AccountVerifyStatus {
  none,
  failed,
  success,
}

export enum RequestResult {
  none,
  failed,
  success,
}

export type AccountState = {
  signinStatus: AccountSigninStatus;
  verifyAccountStatus: AccountVerifyStatus;
  pendingRequest: boolean;
  user: any;
  userLogged: any;
};

export type CartState = {
  items: { [name: string]: CartRow };
  total: number;
  tipologiaConsegna: TipologiaConsegna;
  indirizzo: string;
  orario: string;
  note: string;
};

export type MessagesState = {
  message?: Message | null;
};

export type Message = {
  type: string;
  text: string;
};

export type GeneralSettings = {
  site_title: string;
  site_subtitle: string;
};

export type CurrentUser = {
  email: string;
  firstname: string;
  id: number;
  lastname: string;
  role: string;
};

export interface OrderState {
  id: number;
  name: string;
  cssBadgeClass: string | null;
}

export interface OrderDetail {
  id: number;
  name: string | null;
  quantity: number;
  unitPrice: number;
}

export interface GetOrderDetailResponse {
  id: number;
  orderState: OrderState | null;
  isPaid: boolean;
  isShippingRequired: boolean;
  deliveryAddress: string | null;
  deliveryTime: string | null;
  notes: string | null;
  shippingCosts: number;
  orderDetails: OrderDetail[] | null;
  total: number;
}
