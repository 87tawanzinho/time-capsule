<template>
    <div class="container">
        <!-- Foguete -->
        <div ref="rocket" class="rocket">
            <Icon icon="mdi:rocket" class="text-6xl text-yellow-400" />
        </div>

        <!-- Partículas -->
        <div
            v-for="i in 30"
            :key="i"
            :ref="`particle${i}`"
            class="particle"
        ></div>

        <!-- Explosão de luz -->
        <div ref="explosion" class="explosion"></div>
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import anime from "animejs";
import { Icon } from "@iconify/vue";

export default {
    components: { Icon },
    setup() {
        const rocket = ref(null);
        const particles = ref([]);
        const explosion = ref(null);

        const launchRocket = () => {
            if (rocket.value && explosion.value) {
                // Animação da explosão de luz
                anime({
                    targets: explosion.value,
                    scale: [0, 10],
                    opacity: [1, 0],
                    duration: 500,
                    easing: "easeOutQuad",
                });

                // Animação do foguete (trajetória curva)
                anime({
                    targets: rocket.value,
                    translateY: -500,
                    translateX: [0, 100, -50, 0], // Movimento lateral para simular uma trajetória curva
                    rotate: "1turn", // Gira o foguete durante a decolagem
                    opacity: 0,
                    duration: 2000,
                    easing: "easeInOutQuad",
                });

                // Animação das partículas
                particles.value.forEach((particle, index) => {
                    anime({
                        targets: particle,
                        translateX: anime.random(-200, 200),
                        translateY: anime.random(-200, 200),
                        scale: [1, 0],
                        opacity: [1, 0],
                        duration: anime.random(1000, 2000),
                        easing: "easeOutQuad",
                        delay: anime.random(0, 500),
                    });
                });

                // Tremor na tela
                anime({
                    targets: "body",
                    translateX: [10, -10, 10, -10, 0],
                    duration: 300,
                    easing: "easeInOutQuad",
                });
            }
        };

        // Inicia a animação automaticamente ao montar o componente
        onMounted(() => {
            launchRocket();
        });

        return { rocket, particles, explosion };
    },
};
</script>

<style>
.container {
    position: relative;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    overflow: hidden;
}

.rocket {
    position: absolute;
    bottom: 20px;
    transition: all 0.3s ease;
}

.particle {
    position: absolute;
    bottom: 20px;
    width: 10px;
    height: 10px;
    background-color: #ffeb3b;
    border-radius: 50%;
    opacity: 0;
}

.explosion {
    position: absolute;
    bottom: 20px;
    width: 20px;
    height: 20px;
    background: radial-gradient(circle, rgba(255, 235, 59, 0.8), transparent);
    border-radius: 50%;
    opacity: 0;
}
</style>
