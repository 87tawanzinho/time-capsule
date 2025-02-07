<template>
    <div class="mt-4 flex items-center rounded-lg">
        <!-- ElSelect com DDD e largura pequena -->
        <select
            v-model="formStore.form.areaCode"
            class="bg-transparent text-gray-200 border-0 focus:outline-none focus:ring-2 focus:ring-purple-600 mr-2 rounded-l-lg"
            placeholder="DDD"
            style="width: 80px"
            :popper-append-to-body="false"
            theme="dark"
        >
            <option label="🇧🇷" value="br" />
            <option label="🇵🇹" value="pt" />
        </select>

        <!-- Input de telefone -->
        <input
            v-model="formStore.form.whatsappTo"
            class="w-full bg-transparent text-gray-200 border border-gray-700 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-purple-600"
            placeholder="Número do WhatsApp (com DDD)"
        />
    </div>
</template>

<script setup>
import { useFormStore } from "@/stores/formStore";
const formStore = useFormStore();
</script>

<style scoped>
/* Adicionando estilo adicional, se necessário */
</style>
