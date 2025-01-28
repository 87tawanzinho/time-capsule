<template>
    <Icon :icon="icon" :style="computedStyle" />
</template>

<script setup>
import { defineProps, computed } from "vue";
import { Icon } from "@iconify/vue";

const props = defineProps({
    icon: {
        type: String,
        required: true,
    },
    left: {
        type: String,
        default: "auto",
    },
    right: {
        type: String,
        default: "auto",
    },
    top: {
        type: String,
        default: "auto",
    },
    bottom: {
        type: String,
        default: "auto",
    },
});

const computedStyle = computed(() => ({
    position: "absolute",
    left: props.left,
    right: props.right,
    top: props.top,
    bottom: props.bottom,
}));
</script>

<style scoped>
/* Caso você queira adicionar mais estilos aqui, pode definir estilos adicionais */
</style>
