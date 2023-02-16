import * as yup from "yup";

export default yup.object({
  tipoConsegna: yup.string().required("La tipologia è obbligatoria"),
});
