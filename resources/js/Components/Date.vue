<script setup>
// Importações necessárias
import { ref, onMounted, onBeforeUnmount, computed } from "vue";
import moment from "moment";
import { useFormStore } from "@/stores/formStore";
import "moment/locale/pt-br"; // Importar o locale pt-br
const formStore = useFormStore();
// Configuração do relógio
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);
const selectedDate = ref("");
const message = ref("");
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

const getFormattedTime = (date) => {
    const now = moment();
    const targetDate = moment(date);

    if (targetDate.isSame(now, "day")) {
        return "Sua capsula será enviada hoje mesmo!"; // Não mostrar nada se for o dia atual
    }

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

// Função para desabilitar as datas inválidas
const disabledDate = (time) => {
    const currentDate = new Date();
    const twoYearsLater = new Date();
    twoYearsLater.setFullYear(currentDate.getFullYear() + 2);
    if (time.getTime() < currentDate.getTime()) return true;
    if (time.getTime() > twoYearsLater.getTime()) {
        message.value =
            "Caso a data selecionada seja superior, entre em contato no Discord";
        return true;
    }
    message.value = "";
    return false;
};
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
                v-model="formStore.form.date"
                :min="new Date().toISOString().split('T')[0]"
                :disabled-date="disabledDate"
                class="date-input"
            />
            <div class="selected-date" v-if="formStore.form.date">
                🚀 Sua cápsula será aberta daqui a: <br />
                <span class="highlight">{{
                    getFormattedTime(formStore.form.date)
                }}</span>
            </div>
            <div v-if="message" class="error-message">{{ message }}</div>
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
    margin-top: 0.8rem;
    padding: 0.5rem 1rem;
    background: linear-gradient(12deg, #228b22, #006400);
    border-radius: 8px;
    font-weight: bold;
    color: aliceblue;
    font-size: 1rem;
}

.error-message {
    margin-top: 1rem;
    color: red;
    font-size: 1rem;
    font-weight: bold;
}
</style>
