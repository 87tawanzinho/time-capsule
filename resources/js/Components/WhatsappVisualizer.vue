<template>
    <div
        class="flex flex-col-reverse lg:flex-row justify-between items-center px-0 lg:px-8"
    >
        <div
            class="flex flex-col text-center justify-center items-center ml-0 mt-4 lg:mt-0 lg:ml-24 gap-4"
        >
            <Icon
                icon="ic:sharp-whatsapp"
                class="rounded-lg border-gray-700 text-[100px] text-white cursor-pointer hover:bg-purple-900"
            />
        </div>

        <div class="whatsapp-chat ]">
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
                <!-- Mensagens -->
                <div class="message left">
                    <div
                        class="message-bubble"
                        v-html="formStore.form.message"
                    ></div>
                </div>

                <!-- Mais mensagens para simular o histórico -->
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
                    <Icon icon="famicons:send" class="text-2xl text-black" />
                </button>
            </div>
        </div>
    </div>
    <p
        class="text-center text-gray-500 text-xs mt-12"
        v-if="formStore.form.date"
    >
        Sua mensagem sera enviada em {{ getFormattedTime(formStore.form.date) }}
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
    background-color: #121212; /* Fundo escuro */
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
        background-color: #121212; /* Fundo escuro */
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
    background-color: #202c33; /* Cor do cabeçalho */
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
    align-items: flex-end;
    max-width: 80%;
}

.message.left {
    justify-content: flex-start;
}

.message.right {
    justify-content: flex-end;
}

.message-bubble {
    padding: 10px 15px;
    border-radius: 18px;
    font-size: 14px;
    max-width: 75%;
    word-wrap: break-word;
    background-color: #25d366;
    color: white;
    position: relative;
}

.message.left .message-bubble {
    background-color: #2f3b3e;
}

.message.right .message-bubble {
    background-color: #25d366;
}

.chat-footer {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
}

.chat-footer input {
    flex: 1;
    padding: 10px;
    border-radius: 20px;
    background-color: #333;
    border: 1px solid #555;
    color: white;
    font-size: 14px;
}

.chat-footer button {
    background-color: #25d366;
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
    border-color: #4caf50;
}
</style>
