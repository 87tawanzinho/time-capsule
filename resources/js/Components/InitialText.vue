<template>
    <!-- Ícone de Cápsula -->
    <div class="flex justify-center mb-6">
        <Icon
            icon="game-icons:time-bomb"
            class="text-6xl sm:text-8xl text-gray-300 animate-pulse"
        />
    </div>

    <!-- Texto explicativo -->
    <h1 class="text-4xl sm:text-6xl font-bold text-white text-center mb-8">
        <span
            class="bg-clip-text text-transparent bg-gradient-to-r from-purple-400 to-pink-600"
        >
            Capsula do Tempo
        </span>
        <span class="block text-xl sm:text-2xl mt-4 text-gray-300 font-light">
            Guarde memórias, segredos e mensagens para o futuro.
        </span>
    </h1>

    <div
        v-if="formStore.form.showInformation"
        class="space-y-6 bg-[#121212] bg-opacity-90 p-6 sm:p-8 rounded-xl shadow-lg border border-gray-800"
    >
        <InitialText />

        <!-- Botão "Começar Agora" -->
        <div class="flex justify-center mt-8">
            <button
                @click="formStore.form.showInformation = false"
                class="w-full sm:max-w-md bg-gradient-to-r from-purple-600 to-pink-600 p-4 rounded-xl hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all text-white font-semibold text-lg"
            >
                Começar Agora
            </button>
        </div>
    </div>

    <div class="mt-6 mb-2" v-if="formStore.form.showInformation">
        <Text :number="1" />
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import { useFormStore } from "@/stores/formStore";
import Text from "@/Components/Text.vue";
const formStore = useFormStore();
</script>
