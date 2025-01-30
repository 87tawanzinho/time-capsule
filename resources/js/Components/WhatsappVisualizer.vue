<template>
    <div class="flex justify-between items-center">
        <div class="hidden lg:flex ml-24">
            <Icon icon="ic:sharp-whatsapp" class="text-[100px] text-white" />
        </div>

        <div class="whatsapp-chat">
            <!-- Cabeçalho com o nome do contato e ícone de perfil -->
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
</template>

<script setup>
import { ref, computed } from "vue";
import { useFormStore } from "@/stores/formStore"; // Importando o Pinia store
import { Icon } from "@iconify/vue";
// Criando a instância do store do Pinia
const formStore = useFormStore();

// Definindo a mensagem e o histórico de mensagens
const newMessage = computed(() => formStore.form.message); // Liga ao valor da mensagem no Pinia
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
