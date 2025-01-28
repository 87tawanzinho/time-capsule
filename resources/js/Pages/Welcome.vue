<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import { ref } from "vue";
import {
    ElInput,
    ElUpload,
    ElButton,
    ElSteps,
    ElStep,
    ElCheckbox,
    ElTag,
} from "element-plus";
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
    documentPreview.value = file.name;
};
</script>

<template>
    <Head title="Welcome" />
    <Header />

    <div class="w-full max-w-4xl mx-auto mt-16 px-4">
        <!-- Exibir Steps apenas após clicar em "Começar Agora" -->
        <el-steps
            v-if="!showInformation"
            :active="currentStep"
            class="mb-8 text-gray-300"
            finish-status="success"
        >
            <el-step title="Nome e Anonimato" />
            <el-step title="Mensagem e Data" />
            <el-step title="Foto e Documento" />
        </el-steps>

        <div
            v-if="showInformation"
            class="space-y-6 bg-opacity-90 s rounded-xl shadow-lg"
        >
            <!-- Ícone de Cápsula -->
            <div class="flex justify-center mb-6">
                <Icon
                    icon="game-icons:space-suit"
                    class="text-6xl text-gray-300"
                />
            </div>

            <!-- Texto explicativo -->
            <p class="">
                A expectativa de vida média é de 79,7 anos para as mulheres e
                73,1 anos para os homens.
            </p>
            <p class="l">
                Vivemos como se o tempo fosse infinito. No entanto, ao longo do
                caminho, acumulamos conflitos, mágoas e até mesmo a falta de
                afeto. Esquecemos de demonstrar o quanto amamos aqueles que mais
                nos amam.
            </p>
            <p class="">
                Com as cápsulas do tempo, podemos eternizar sentimentos,
                memórias, informações valiosas, histórias e muito mais. Envie
                mensagens para o futuro — sejam em áudio, foto ou texto — para
                aqueles que você ama e quer marcar para sempre, mesmo que no
                futuro.
            </p>

            <button
                @click="showInformation = false"
                class="mt-8 w-64 bg-yellow-600 p-2 rounded-2xl hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all text-white"
            >
                Comece Agora
            </button>
        </div>

        <!-- Formulário de Etapas (Só aparece após "Começar Agora") -->
        <div v-else class="space-y-8">
            <!-- Etapa 1: Nome e Anonimato -->
            <div
                v-if="currentStep === 0"
                class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg space-y-6 relative"
            >
                <div
                    class="absolute inset-0 bg-[url('/path-to-your-stars-image.jpg')] bg-cover bg-center opacity-20"
                ></div>
                <p class="text-lg font-medium text-gray-300">
                    Qual o nome da pessoa que você quer marcar para sempre?
                </p>
                <el-input
                    v-model="name"
                    class="w-full bg-transparent text-gray-200 border border-gray-600 focus:ring-2 focus:ring-purple-600"
                    placeholder="Nome"
                    size="large"
                />

                <div class="mt-4 flex items-center justify-between">
                    <p class="font-medium text-gray-300">Me manter anônimo</p>
                    <el-checkbox
                        v-model="sendWithWhatsapp"
                        class="text-gray-300"
                    />
                </div>
            </div>

            <!-- Etapa 2: Mensagem e Data -->
            <div
                v-if="currentStep === 1"
                class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg space-y-6 relative"
            >
                <div
                    class="absolute inset-0 bg-[url('/path-to-your-stars-image.jpg')] bg-cover bg-center opacity-20"
                ></div>
                <div class="space-y-4">
                    <div>
                        <p class="text-lg font-medium text-gray-300">
                            Mensagem
                        </p>
                        <el-input
                            v-model="message"
                            class="w-full bg-transparent text-gray-200 border border-gray-600 focus:ring-2 focus:ring-purple-600"
                            placeholder="Digite um belo texto.."
                            type="textarea"
                            size="large"
                        />
                    </div>

                    <div>
                        <p class="text-lg font-medium text-gray-300">
                            A data que sua cápsula será enviada
                        </p>
                        <el-input
                            v-model="date"
                            class="w-full bg-transparent text-gray-200 border border-gray-600 focus:ring-2 focus:ring-purple-600"
                            type="date"
                            size="large"
                        />
                    </div>
                </div>
            </div>

            <!-- Etapa 3: Foto e Documento -->
            <div
                v-if="currentStep === 2"
                class="bg-[#121212] bg-opacity-90 p-8 rounded-xl shadow-lg space-y-6 relative"
            >
                <div
                    class="absolute inset-0 bg-[url('/path-to-your-stars-image.jpg')] bg-cover bg-center opacity-20"
                ></div>
                <div class="space-y-6">
                    <!-- Foto -->
                    <div>
                        <p class="text-lg font-medium text-gray-300">
                            Foto (opcional)
                        </p>
                        <el-upload
                            action=""
                            accept="image/*"
                            @change="
                                (uploadFile) => previewPhoto(uploadFile.raw)
                            "
                            :show-file-list="false"
                            class="cursor-pointer"
                        >
                            <template #trigger>
                                <div class="relative group">
                                    <div
                                        v-if="photoPreview"
                                        class="w-32 h-32 rounded-full overflow-hidden border-2 border-dashed border-gray-600 hover:border-blue-600"
                                    >
                                        <img
                                            :src="photoPreview"
                                            class="w-full h-full object-cover"
                                            alt="Preview da Foto"
                                        />
                                    </div>
                                    <div
                                        v-else
                                        class="w-32 h-32 rounded-full border border-gray-500 hover:border-blue-600 flex items-center justify-center"
                                    >
                                        <Icon
                                            icon="material-symbols:photo-camera-outline"
                                            class="text-3xl text-gray-400 group-hover:text-blue-600"
                                        />
                                    </div>
                                    <div
                                        class="absolute bottom-0 right-0 bg-gray-800 rounded-full p-1 shadow-md"
                                    >
                                        <Icon
                                            icon="material-symbols:edit-outline"
                                            class="text-blue-600 text-lg"
                                        />
                                    </div>
                                </div>
                            </template>
                        </el-upload>
                    </div>

                    <!-- Documento -->
                    <div>
                        <p class="text-lg font-medium text-gray-300">
                            Documento (opcional)
                        </p>
                        <el-upload
                            action=""
                            accept=".pdf,.doc,.docx"
                            @change="
                                (uploadFile) => previewDocument(uploadFile.raw)
                            "
                            :show-file-list="false"
                            class="cursor-pointer"
                        >
                            <template #trigger>
                                <div class="flex items-center gap-2 group">
                                    <div
                                        v-if="documentPreview"
                                        class="p-2 rounded border border-gray-600 hover:border-blue-600"
                                    >
                                        <el-tag
                                            type="primary"
                                            class="text-xs font-semibold"
                                            >{{ documentPreview }}</el-tag
                                        >
                                    </div>
                                    <div
                                        v-else
                                        class="p-4 border border-gray-600 rounded-lg hover:border-blue-600 flex items-center gap-2"
                                    >
                                        <Icon
                                            icon="material-symbols:description-outline"
                                            class="text-2xl text-gray-400 group-hover:text-blue-600"
                                        />
                                        <span
                                            class="text-gray-500 group-hover:text-blue-600"
                                            >Escolher Documento</span
                                        >
                                    </div>
                                </div>
                            </template>
                        </el-upload>
                    </div>
                </div>
            </div>

            <!-- Botões de Navegação -->
            <div class="flex justify-between mt-8 space-x-4">
                <el-button
                    v-if="currentStep > 0"
                    @click="currentStep--"
                    type="primary"
                    class="w-32 bg-[#2e3b4e] text-gray-200 hover:bg-[#475a6b] transition-all"
                >
                    Voltar
                </el-button>
                <el-button
                    v-if="currentStep < 2"
                    @click="currentStep++"
                    type="primary"
                    class="w-32 bg-[#2e3b4e] text-gray-200 hover:bg-[#475a6b] transition-all"
                >
                    Próximo
                </el-button>
                <el-button
                    v-if="currentStep === 2"
                    @click="submitForm"
                    type="success"
                    class="w-32 bg-[#2e3b4e] text-gray-200 hover:bg-[#475a6b] transition-all"
                >
                    Enviar
                </el-button>
            </div>
        </div>
    </div>
</template>
