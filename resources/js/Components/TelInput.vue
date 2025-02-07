<template>
    <el-form :model="form">
        <el-row>
            <el-col :span="6">
                <el-select
                    v-model="selectedCountry"
                    placeholder="Selecione o país"
                >
                    <el-option value="br">
                        <template #label>
                            <Icon
                                icon="twemoji:flag-for-brazil"
                                style="font-size: 20px; margin-right: 8px"
                            />
                            (+55) Brasil
                        </template>
                    </el-option>
                    <el-option value="us">
                        <template #label>
                            <Icon
                                icon="twemoji:flag-for-us"
                                style="font-size: 20px; margin-right: 8px"
                            />
                            (+1) Estados Unidos
                        </template>
                    </el-option>
                    <el-option value="gb">
                        <template #label>
                            <Icon
                                icon="twemoji:flag-for-united-kingdom"
                                style="font-size: 20px; margin-right: 8px"
                            />
                            (+44) Reino Unido
                        </template>
                    </el-option>
                </el-select>
            </el-col>
        </el-row>
    </el-form>
</template>

<script>
import { ref, computed } from "vue";
import { Icon } from "@iconify/vue"; // Importando o componente Icon

export default {
    components: {
        Icon, // Registrando o componente Icon
    },
    setup() {
        const form = ref({
            phone: "",
        });

        const selectedCountry = ref("br"); // Valor inicial para o Brasil

        const countryCode = computed(() => {
            // Retorna o código do país conforme o selecionado
            switch (selectedCountry.value) {
                case "us":
                    return "+1";
                case "gb":
                    return "+44";
                case "br":
                default:
                    return "+55";
            }
        });

        return {
            form,
            selectedCountry,
            countryCode,
        };
    },
};
</script>

<style scoped>
/* Adicionando estilo para os ícones */
.Icon {
    font-size: 20px;
    margin-right: 8px;
}
</style>
