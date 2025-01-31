<template>
    <div
        class="flex flex-col-reverse lg:flex-row justify-between items-center px-0 lg:px-8"
        title="Ilustração de uma cápsula do tempo no whatsapp"
    >
        <div
            class="flex flex-col text-center justify-center items-center ml-0 mt-4 lg:mt-0 lg:ml-24 gap-4"
        >
            <Icon
                icon="mdi:whatsapp"
                class="rounded-lg border-gray-700 text-[100px] text-green-500 cursor-pointer hover:bg-green-900"
            />
        </div>

        <div class="whatsapp-chat">
            <div class="chat-header">
                <div class="profile">
                    <img src="/capsule.jpg" alt="Perfil" class="profile-img" />
                </div>
                <div class="header-text">
                    <h3>Capsula do Tempo</h3>
                    <p>online</p>
                </div>
            </div>

            <!-- Corpo da conversa -->
            <div class="chat-body">
                <!-- Mensagem como uma cápsula do tempo -->
                <div class="message left gap-2">
                    <div v-if="formStore.form.message" class="message-bubble">
                        <div
                            class="message-content"
                            v-html="formStore.form.message"
                        ></div>
                        <!-- Detalhes da carta secreta -->
                        <div class="letter-details">
                            <div class="sender">
                                <Icon icon="mdi:rocket-launch" class="icon" />
                                <span
                                    >De:
                                    {{
                                        formStore.form.owner &&
                                        formStore.form.dontShowOwner === false
                                            ? formStore.form.owner
                                            : "um desconhecido"
                                    }}</span
                                >
                            </div>
                            <div class="receiver">
                                <Icon icon="mdi:planet" class="icon" />
                                <span
                                    >Destinado a:
                                    {{ formStore.form.name }}</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Barra de entrada de texto -->
            <div class="chat-footer">
                <input
                    type="text"
                    v-model="newMessage.value"
                    placeholder="Digite uma mensagem..."
                    @keyup.enter="sendMessage"
                />
                <button @click="sendMessage">
                    <Icon icon="mdi:send" class="text-2xl text-green-500" />
                </button>
            </div>
        </div>
    </div>
    <p
        class="text-center text-gray-500 text-xs mt-12"
        v-if="formStore.form.date"
    >
        Sua mensagem será enviada em {{ getFormattedTime(formStore.form.date) }}
    </p>
</template>

<script setup>
import moment from "moment";
import { ref, computed } from "vue";
import { useFormStore } from "@/stores/formStore"; // Importando o Pinia store
import { Icon } from "@iconify/vue";

// Criando a instância do store do Pinia
const formStore = useFormStore();

// Definindo a mensagem e o histórico de mensagens
const newMessage = computed(() => formStore.form.message); // Liga ao valor da mensagem no Pinia

const getFormattedTime = (date) => {
    const now = moment();
    const targetDate = moment(date);

    const years = targetDate.diff(now, "years");
    const months = targetDate.diff(now, "months") % 12;
    const days = targetDate.diff(now, "days") % 30;
    const hours = targetDate.diff(now, "hours") % 24;
    const minutes = targetDate.diff(now, "minutes") % 60;

    let timeString = "";

    if (years > 0) {
        timeString += `${years} ano${years > 1 ? "s" : ""}, `;
    }
    if (months > 0) {
        timeString += `${months} mês${months > 1 ? "es" : ""}, `;
    }
    if (days > 0) {
        timeString += `${days} dia${days > 1 ? "s" : ""}, `;
    }
    if (hours > 0) {
        timeString += `${hours} hora${hours > 1 ? "s" : ""}, `;
    }
    if (minutes > 0) {
        timeString += `${minutes} minuto${minutes > 1 ? "s" : ""}`;
    }

    return timeString;
};
</script>

<style scoped>
/* Container principal */
.whatsapp-chat {
    width: 40%;
    max-width: 600px;
    height: 60vh;
    background-color: #0b141a; /* Fundo escuro do WhatsApp */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

@media (max-width: 600px) {
    .whatsapp-chat {
        width: 100%;
        max-width: 600px;
        height: 60vh;
        background-color: #0b141a; /* Fundo escuro do WhatsApp */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
}

/* Cabeçalho */
.chat-header {
    background-color: #202c33; /* Cor do cabeçalho do WhatsApp */
    color: white;
    padding: 14px;
    display: flex;
    align-items: center;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
}

.profile {
    margin-right: 10px;
}

.profile-img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
}

.header-text h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 600;
}

.header-text p {
    margin: 0;
    font-size: 12px;
    color: #919191;
}

/* Corpo da conversa */
.chat-body {
    flex: 1;
    padding: 16px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.message {
    display: flex;
    flex-direction: column;
    justify-items: center;
    max-width: 95%;
}

.message.left {
    justify-content: flex-start;
}

.message-bubble {
    padding: 16px;
    border-radius: 8px;
    font-size: 14px;
    max-width: 75%;
    word-wrap: break-word;
    background-color: #202c33; /* Cor das mensagens recebidas */
    color: white;
    position: relative;
}

.message-content {
    margin-bottom: 12px;
}

.letter-details {
    border-top: 1px solid #2a3942;
    padding-top: 12px;
    font-size: 12px;
    color: #919191;
}

.sender,
.receiver {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.icon {
    font-size: 16px;
    color: #df7fde; /* Cor do ícone */
}

/* Rodapé */
.chat-footer {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
    background-color: #202c33; /* Cor do rodapé */
}

.chat-footer input {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    background-color: #2a3942; /* Cor do input */
    border: 1px solid #2a3942;
    color: white;
    font-size: 14px;
}

.chat-footer button {
    background-color: #005c4b; /* Cor do botão de enviar */
    border: none;
    padding: 10px;
    border-radius: 50%;
    margin-left: 8px;
    cursor: pointer;
}

.chat-footer button .material-icons {
    font-size: 20px;
    color: white;
}

.chat-footer input:focus {
    outline: none;
    border-color: #005c4b;
}
</style>
