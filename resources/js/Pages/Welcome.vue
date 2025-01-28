<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import { ref } from "vue"; // Importando ref diretamente do Vue
import Star from "@/Components/Star.vue";
import { Icon } from "@iconify/vue";

const showInformation = ref(true);
</script>

<template>
    <Head title="Welcome" />
    <div>
        <Header />

        <div class="flex flex-col items-center justify-center mt-32">
            <div class="w-2/4 h-full" v-if="showInformation">
                <p class="mb-4">
                    A expectativa de vida média é de 79,7 anos para as mulheres
                    e 73,1 anos para os homens.
                </p>
                <p>
                    Vivemos como se o tempo fosse infinito. No entanto, ao longo
                    do caminho, acumulamos conflitos, mágoas e até mesmo a falta
                    de afeto. Esquecemos de demonstrar o quanto amamos aqueles
                    que mais nos amam e, muitas vezes, deixamos de expressar o
                    que realmente sentimos. Quando a oportunidade passa, restam
                    as palavras não ditas, os sentimentos não compartilhados, e
                    memórias que poderiam ter sido mais profundas.
                </p>

                <p class="mt-8">
                    Com as cápsulas do tempo, podemos eternizar sentimentos,
                    memórias, informações valiosas, histórias e muito mais.
                    Envie mensagens para o futuro — sejam em áudio, foto ou
                    texto — para aqueles que você ama e quer marcar para sempre,
                    mesmo que no futuro.
                </p>

                <button
                    @click="showInformation = false"
                    class="mt-6 bg-yellow-300 p-2 px-6 rounded-lg hover:bg-yellow-500 text-black transition-all"
                >
                    Comece Agora
                </button>
            </div>
            <div v-else class="w-2/4 h-full">
                <div>
                    <Icon
                        @click="() => (showInformation = true)"
                        icon="lets-icons:back-light"
                        class="text-yellow-400 text-2xl mb-4 hover:text-yellow-500 cursor-pointer"
                    />
                    <p>
                        Qual o nome da pessoa que você quer marcar para sempre?
                    </p>
                    <input class="w-full mt-2" type="text" placeholder="Nome" />
                </div>

                <div class="mt-4">
                    <p>Mensagem</p>
                    <textarea
                        class="w-full mt-2"
                        type="text"
                        placeholder="Digite um belo texto.."
                    />
                </div>

                <div class="mt-4">
                    <p>Fotos (opcional)</p>
                    <textarea
                        class="w-full mt-2"
                        type="text"
                        placeholder="Digite um belo texto.."
                    />
                </div>
            </div>
        </div>
    </div>
</template>
