<script setup>
// Importações necessárias
import { ref, onMounted, onBeforeUnmount, computed } from "vue";

// Configuração do relógio
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);
const selectedDate = ref("");
const monthNames = [
    "Janeiro",
    "Fevereiro",
    "Março",
    "Abril",
    "Maio",
    "Junho",
    "Julho",
    "Agosto",
    "Setembro",
    "Outubro",
    "Novembro",
    "Dezembro",
];

// Configuração inicial da data
onMounted(() => {
    const now = new Date();
    const defaultDate = new Date(now.setFullYear(now.getFullYear() + 1));
    selectedDate.value = defaultDate.toISOString().split("T")[0];
});

// Atualização suave do relógio
let animationFrame;
const updateClock = () => {
    const now = new Date();
    hours.value = now.getHours() % 12;
    minutes.value = now.getMinutes();
    seconds.value = now.getSeconds() + now.getMilliseconds() / 1000;

    animationFrame = requestAnimationFrame(updateClock);
};

onMounted(() => {
    updateClock();
});

onBeforeUnmount(() => {
    cancelAnimationFrame(animationFrame);
});

// Formatação da data selecionada usando computed
const formattedDate = computed(() => {
    if (!selectedDate.value) return "Selecione uma data";
    const [year, month, day] = selectedDate.value.split("-");
    return `${parseInt(day)} de ${monthNames[parseInt(month) - 1]} de ${year}`;
});
</script>

<template>
    <div class="datetime-selector">
        <!-- Relógio Analógico -->
        <div class="analog-clock">
            <div class="dial">
                <!-- Marcadores de horas -->
                <div
                    v-for="n in 12"
                    :key="n"
                    class="hour-mark"
                    :style="{ transform: `rotate(${n * 30}deg)` }"
                ></div>

                <!-- Ponteiros -->
                <div
                    class="hour-hand"
                    :style="{
                        transform: `rotate(${hours * 30 + minutes * 0.5}deg)`,
                    }"
                ></div>
                <div
                    class="minute-hand"
                    :style="{
                        transform: `rotate(${minutes * 6 + seconds * 0.1}deg)`,
                    }"
                ></div>
                <div
                    class="second-hand"
                    :style="{ transform: `rotate(${seconds * 6}deg)` }"
                ></div>

                <!-- Centro -->
                <div class="center"></div>
            </div>
        </div>

        <!-- Seletor de Data -->
        <div class="date-picker">
            <input
                type="date"
                v-model="selectedDate"
                :min="new Date().toISOString().split('T')[0]"
                class="date-input"
            />
            <div class="selected-date">
                🚀 Sua cápsula será aberta em: <br />
                <span class="highlight">{{ formattedDate }}</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.datetime-selector {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    padding: 2rem;
}

.analog-clock {
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    box-shadow: 0 0 30px rgba(147, 51, 234, 0.3);
    position: relative;
}

.dial {
    position: absolute;
    width: 90%;
    height: 90%;
    top: 5%;
    left: 5%;
}

.hour-mark {
    position: absolute;
    width: 2px;
    height: 12px;
    background: #6b46c1;
    left: 50%;
    top: 5%;
    transform-origin: bottom;
}

.hour-hand,
.minute-hand,
.second-hand {
    position: absolute;
    background: white;
    border-radius: 4px;
    transform-origin: bottom;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.hour-hand {
    width: 4px;
    height: 50px;
    bottom: 50%;
    left: calc(50% - 2px);
    background: #e9d8fd;
}

.minute-hand {
    width: 3px;
    height: 70px;
    bottom: 50%;
    left: calc(50% - 1.5px);
    background: #d6bcfa;
}

.second-hand {
    width: 2px;
    height: 80px;
    bottom: 50%;
    left: calc(50% - 1px);
    background: #f687b3;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.center {
    position: absolute;
    width: 10px;
    height: 10px;
    background: #f687b3;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 10px rgba(246, 135, 179, 0.5);
}

.date-picker {
    text-align: center;
}

.date-input {
    margin: 1rem 0;
    padding: 0.5rem;
    background: #2d3748;
    border: 1px solid #4a5568;
    border-radius: 6px;
    color: white;
    font-size: 1rem;
}

.highlight {
    display: inline-block;
    margin-top: 0.5rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(45deg, #805ad5, #d53f8c);
    border-radius: 8px;
    font-weight: bold;
    font-size: 1.2rem;
}
</style>
