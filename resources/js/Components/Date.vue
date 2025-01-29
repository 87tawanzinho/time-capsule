<template>
    <header class="stars">
        <div
            class="bg-black flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
        >
            <div>
                <h1>Capsula do Tempo</h1>
            </div>

            <div class="flex gap-4">
                <div class="light flex items-center gap-2">
                    <button>Enviar uma capsula</button>

                    <Icon
                        icon="mingcute:capsule-fill"
                        class="text-yellow-300"
                    />
                </div>
            </div>
        </div>
    </header>

    <!-- Novo Step para escolher data -->
    <section class="step-data py-8">
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl max-w-xl mx-auto">
            <h2 class="text-center text-xl text-white font-bold mb-6">
                Escolha a Data
            </h2>

            <!-- Relógio Dinâmico -->
            <div class="clock-container text-center mb-6">
                <input type="date" v-model="date" class="date-picker" />
            </div>

            <!-- Data Display -->
            <div class="date-display text-white">
                <p>Data Selecionada: {{ date }}</p>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from "vue";

const date = ref("");
</script>

<style scoped>
/* Estilizando o relógio e a data */
.step-data {
    background-color: #111;
}

.clock-container input[type="date"] {
    width: 100%;
    padding: 15px;
    font-size: 1.5rem;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 10px;
    text-align: center;
    cursor: pointer;
}

.clock-container input[type="date"]:focus {
    outline: none;
    background-color: #444;
}

.date-display {
    font-size: 1rem;
    font-family: "Arial", sans-serif;
    color: #f1f1f1;
}

h2 {
    font-family: "Roboto", sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
}
</style>
