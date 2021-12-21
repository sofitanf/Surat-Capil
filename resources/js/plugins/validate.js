import {
    Form as VeeForm,
    Field as VeeField,
    ErrorMessage,
    defineRule,
    configure,
} from "vee-validate";
import {
    required,
    numeric,
    alpha_spaces,
    size,
    ext,
} from "@vee-validate/rules";

export default {
    install(app) {
        app.component("VeeForm", VeeForm);
        app.component("VeeField", VeeField);
        app.component("ErrorMessage", ErrorMessage);

        defineRule("numeric", numeric);
        defineRule("required", required);
        defineRule("size", size);
        defineRule("alpha_spaces", alpha_spaces);
        defineRule("ext", ext);

        configure({
            generateMessage: (ctx) => {
                const messages = {
                    required: `${ctx.field} harus diisi`,
                    numeric: `${ctx.field} harus berupa angka`,
                    size: `Ukuran file maksimal 10MB`,
                    ext: `Ukuran file maksimal 10MB`,
                };

                const message = messages[ctx.rule.name] ?
                    messages[ctx.rule.name] :
                    `${ctx.field} tidak valid`;

                return message;
            },
            validateOnBlur: true,
            validateOnChange: true,
            validateOnInput: true,
            validateOnModelUpdate: true,
        });
    },
};