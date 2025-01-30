<template>
    <div v-if="number === 1">
        <p class="text-gray-400 text-base sm:text-lg mb-4">
            Imagine poder enviar uma mensagem para o futuro, algo que será
            aberto daqui a 5, 10 ou até 20 anos. Uma declaração de amor, um
            segredo guardado, ou até mesmo uma mensagem profissional. Com a
            Cápsula do Tempo, você pode eternizar momentos e sentimentos que
            serão revelados no momento certo.
        </p>

        <p class="text-gray-400 text-base sm:text-lg">
            A vida é feita de momentos efêmeros, mas alguns sentimentos merecem
            ser lembrados para sempre. O que você gostaria de dizer para o
            futuro?
        </p>
    </div>
</template>

<script setup>
const props = defineProps({
    number: {
        type: Number,
        required: true,
    },
});
</script>
