<template>
    <header class="stars">
        <div
            class="bg-black flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
        >
            <div>
                <h1>Capsula do tempo</h1>
            </div>

            <div class="flex gap-4">
                <div class="light flex items-center gap-2">
                    <button>Quem somos</button>
                </div>

                <div class="light flex items-center gap-2">
                    <button>Discord</button>

                    <Icon
                        icon="ic:baseline-discord"
                        class="text-purple-400 text-2xl"
                    />
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import Star from "@/Components/Star.vue";
import { Icon } from "@iconify/vue";
</script>
