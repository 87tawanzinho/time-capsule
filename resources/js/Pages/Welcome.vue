<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import { ref } from "vue";
import { Icon } from "@iconify/vue";

const name = ref("");
const message = ref("");
const date = ref("");
const photos = ref("");
const sendWithWhatsapp = ref(false);
const sendWithEmail = ref(false);

const currentStep = ref(0);
const photoPreview = ref(null);
const documentPreview = ref(null);
const showInformation = ref(true);

const previewPhoto = (file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
};

const previewDocument = (file) => {
    const reader = new FileReader();
    reader.onload = (e) => {
        documentPreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
};
</script>

<template>
    <Head title="Cápsula do Tempo" />
    <Header />

    <div class="w-full max-w-4xl mx-auto mt-2 px-4">
        <!-- Efeito de estrelas no fundo -->
        <div
            class="absolute inset-0 bg-[url('/path-to-stars.jpg')] bg-cover bg-center opacity-20"
        ></div>

        <!-- Conteúdo Principal -->
        <div class="relative z-10">
            <!-- Tela Inicial -->
            <div
                v-if="showInformation"
                class="space-y-6 bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg border border-gray-800"
            >
                <!-- Ícone de Cápsula -->
                <div class="flex justify-center mb-6">
                    <Icon
                        icon="game-icons:time-bomb"
                        class="text-8xl text-gray-300 animate-pulse"
                    />
                </div>

                <!-- Texto explicativo -->
                <h1 class="text-6xl font-bold text-white text-center mb-8">
                    <span
                        class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
                    >
                        Cápsula do Tempo
                    </span>
                    <span class="block text-2xl mt-4 text-gray-300 font-light">
                        Guarde memórias, segredos e mensagens para o futuro.
                    </span>
                </h1>

                <!-- Botão "Começar Agora" -->
                <div class="flex justify-center mt-8">
                    <button
                        @click="showInformation = false"
                        class="w-full max-w-md bg-gradient-to-r from-purple-600 to-pink-600 p-4 rounded-xl hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all text-white font-semibold text-lg"
                    >
                        Começar Agora
                    </button>
                </div>
            </div>

            <div class="mt-6 mb-2" v-if="showInformation">
                <p class="text-gray-400 text-lg mb-4">
                    Imagine poder enviar uma mensagem para o futuro, algo que
                    será aberto daqui a 5, 10 ou até 20 anos. Uma declaração de
                    amor, um segredo guardado, ou até mesmo uma mensagem
                    profissional. Com a Cápsula do Tempo, você pode eternizar
                    momentos e sentimentos que serão revelados no momento certo.
                </p>

                <p class="text-gray-400 text-lg">
                    A vida é feita de momentos efêmeros, mas alguns sentimentos
                    merecem ser lembrados para sempre. O que você gostaria de
                    dizer para o futuro?
                </p>
            </div>

            <!-- Formulário de Etapas -->
            <div v-if="!showInformation" class="space-y-8">
                <!-- Etapa 1: Mini Relógio -->
                <div
                    v-if="currentStep === 0"
                    class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg border border-gray-800 space-y-6"
                >
                    <h2 class="text-3xl font-bold text-white mb-4">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
                        >
                            Passo 1: Hora do Futuro
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg">
                        Veja a cápsula do tempo tomando forma. Escolha o momento
                        em que você quer enviar sua mensagem. O futuro espera.
                    </p>

                    <!-- Mini relógio -->
                    <div class="flex justify-center items-center">
                        <div
                            class="relative w-20 h-20 border-4 border-gray-700 rounded-full"
                        >
                            <div
                                class="absolute inset-0 flex items-center justify-center"
                            >
                                <div
                                    class="w-1.5 h-1.5 bg-purple-600 rounded-full animate-ping"
                                ></div>
                            </div>
                            <div
                                class="absolute inset-0 flex justify-center items-center"
                            >
                                <span class="text-2xl text-white font-bold"
                                    >12:00</span
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Etapa 2: Nome e Anonimato -->
                <div
                    v-if="currentStep === 1"
                    class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg border border-gray-800 space-y-6"
                >
                    <h2 class="text-3xl font-bold text-white mb-4">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
                        >
                            Passo 2: Quem Receberá?
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg">
                        Para quem você está enviando esta cápsula do tempo? Pode
                        ser um amigo, familiar, ou até você mesmo no futuro.
                    </p>

                    <!-- Input do nome -->
                    <input
                        v-model="name"
                        class="w-full bg-transparent text-gray-200 border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600 mt-4"
                        placeholder="Nome do destinatário"
                    />

                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-gray-300">Manter anonimato</p>
                        <label class="switch">
                            <input type="checkbox" v-model="sendWithWhatsapp" />
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Etapa 3: Mensagem e Data -->
                <div
                    v-if="currentStep === 2"
                    class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg border border-gray-800 space-y-6"
                >
                    <h2 class="text-3xl font-bold text-white mb-4">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
                        >
                            Passo 3: Sua Mensagem
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg">
                        Escreva uma mensagem para o futuro. Ela será guardada e
                        revelada no momento certo. Pode ser uma declaração, um
                        segredo ou qualquer pensamento especial.
                    </p>
                    <textarea
                        v-model="message"
                        class="w-full bg-transparent text-gray-200 border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600"
                        placeholder="Digite sua mensagem..."
                        rows="6"
                    ></textarea>
                </div>

                <!-- Etapa 4: Foto e Documento -->
                <div
                    v-if="currentStep === 3"
                    class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg border border-gray-800 space-y-6"
                >
                    <h2 class="text-3xl font-bold text-white mb-4">
                        <span
                            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
                        >
                            Passo 4: Anexos
                        </span>
                    </h2>
                    <p class="text-gray-400 text-lg">
                        Adicione fotos ou documentos para enriquecer sua cápsula
                        do tempo. Eles serão guardados junto com sua mensagem e
                        entregues no momento certo.
                    </p>

                    <!-- Foto -->
                    <div>
                        <p class="text-gray-300 text-lg mb-2">
                            Foto (opcional)
                        </p>
                        <div
                            @click="() => $refs.photoInput.click()"
                            class="cursor-pointer"
                        >
                            <div class="relative group">
                                <div
                                    v-if="photoPreview"
                                    class="w-32 h-32 rounded mt-2 overflow-hidden border-2 border-dashed border-gray-700 hover:border-purple-600"
                                >
                                    <img
                                        :src="photoPreview"
                                        class="w-full h-full object-cover"
                                        alt="Preview da Foto"
                                    />
                                </div>
                                <div
                                    v-else
                                    class="w-32 h-32 text-2xl rounded mt-2 border border-gray-700 hover:border-purple-600 flex items-center justify-center"
                                >
                                    +
                                </div>
                            </div>
                            <input
                                type="file"
                                ref="photoInput"
                                class="hidden"
                                @change="(e) => previewPhoto(e.target.files[0])"
                            />
                        </div>
                    </div>

                    <!-- Documento -->
                    <div>
                        <p class="text-gray-300 text-lg mb-2">
                            Documento (opcional)
                        </p>
                        <div
                            @click="() => $refs.documentInput.click()"
                            class="cursor-pointer"
                        >
                            <div class="flex items-center gap-2 group">
                                <div
                                    v-if="documentPreview"
                                    class="p-2 rounded border border-gray-700 hover:border-purple-600"
                                >
                                    <span
                                        class="text-xs font-semibold text-gray-300"
                                    >
                                        Documento selecionado
                                    </span>
                                </div>
                                <div
                                    v-else
                                    class="p-4 border border-gray-700 rounded-lg hover:border-purple-600 flex items-center gap-2"
                                >
                                    <Icon
                                        icon="material-symbols:description-outline"
                                        class="text-2xl text-gray-400 group-hover:text-purple-600"
                                    />
                                    <span
                                        class="text-gray-500 group-hover:text-purple-600"
                                        >Escolher Documento</span
                                    >
                                </div>
                            </div>
                            <input
                                type="file"
                                ref="documentInput"
                                class="hidden"
                                @change="
                                    (e) => previewDocument(e.target.files[0])
                                "
                            />
                        </div>
                    </div>
                </div>

                <!-- Botões de Navegação -->
                <div class="flex justify-end mt-8 space-x-4">
                    <button
                        v-if="currentStep > 0"
                        @click="currentStep--"
                        class="w-32 bg-gray-700 text-gray-200 p-3 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all"
                    >
                        Voltar
                    </button>
                    <button
                        v-if="currentStep < 3"
                        @click="currentStep++"
                        class="w-32 bg-gradient-to-r from-purple-600 to-pink-600 p-3 rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-white font-semibold"
                    >
                        Próximo
                    </button>
                    <button
                        v-if="currentStep === 3"
                        @click="submitForm"
                        class="w-32 bg-gradient-to-r from-purple-600 to-pink-600 p-3 rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-600 transition-all text-white font-semibold"
                    >
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* Estilos personalizados para o toggle switch */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #4a5568;
    transition: 0.4s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #6b46c1;
}

input:checked + .slider:before {
    transform: translateX(26px);
}
</style>
