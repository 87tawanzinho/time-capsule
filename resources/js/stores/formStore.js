// stores/formStore.js
import { defineStore } from "pinia";
import { ref } from "vue";

const getTodayDate = () => {
    const today = new Date();
    return today.toISOString().split("T")[0]; // Pega a data atual no formato 'YYYY-MM-DD'
};

export const useFormStore = defineStore("form", () => {
    const form = ref({
        name: "",
        message: "", // A mensagem que você vai enviar
        date: getTodayDate(),
        photo: null,
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
        whatsappToNotificationsOwner: "",
        areaCode: "55",
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
