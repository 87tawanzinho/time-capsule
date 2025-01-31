// stores/formStore.js
import { defineStore } from "pinia";
import { ref } from "vue";

export const useFormStore = defineStore("form", () => {
    const form = ref({
        name: "",
        message: "", // A mensagem que você vai enviar
        date: "",
        photos: null,
        sendWithWhatsapp: false,
        sendWithEmail: false,
        showOwner: false,
        currentStep: 0,
        photoPreview: null,
        documentPreview: null,
        showInformation: true,
        whatsappTo: "",
        emailAddress: "",
        dontShowOwner: true,
        enableNotifications: false,
        whatsappToNotificationsOwner: "",
    });

    const setFormData = (key, value) => {
        form.value[key] = value;
    };

    const resetForm = () => {
        form.value = {
            name: "",
            message: "",
            date: "",
            photos: null,
            sendWithWhatsapp: false,
            sendWithEmail: false,
            showOwner: false,
            currentStep: 0,
            photoPreview: null,
            documentPreview: null,
            showInformation: true,
            whatsappNumber: "",
            emailAddress: "",
            enableNotifications: false,
            userWhatsappNumber: "",
        };
    };

    return {
        form,
        setFormData,
        resetForm,
    };
});
