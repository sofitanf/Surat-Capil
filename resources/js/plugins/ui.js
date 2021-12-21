import ConfirmationService from "primevue/confirmationservice";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import FileUpload from "primevue/fileupload";
import Toast from "primevue/toast";

export default {
    install(app) {
        app.component("ConfirmationService", ConfirmationService);
        app.component("DataTable", DataTable);
        app.component("InputText", InputText);
        app.component("Column", Column);
        app.component("Button", Button);
        app.component("Calendar", Calendar);
        app.component("Dropdown", Dropdown);
        app.component("FileUpload", FileUpload);
        app.component("Toast", Toast);
    },
};