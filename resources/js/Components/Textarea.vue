<template>
    <div class="editor-container">
        <quill-editor
            ref="quillEditor"
            v-model:content="formStore.form.message"
            contentType="html"
            theme="snow"
            :toolbar="toolbarOptions"
            class="custom-editor"
            placeholder="Escreva algo..."
        ></quill-editor>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { useFormStore } from "@/stores/formStore"; // Importando o Pinia store

const formStore = useFormStore();

// Opções de ferramentas no Quill Editor
const toolbarOptions = [
    [{ header: [1, 2, 3, false] }], // Cabeçalhos H1, H2, H3
    [{ font: [] }], // Seleção de fonte
    [{ size: ["small", false, "large", "huge"] }], // Tamanhos de fonte
    ["bold"], // Negrito
    [{ color: [] }, { background: [] }], // Cor do texto e fundo
    [{ align: [] }], // Alinhamento do texto
    [{ list: "ordered" }, { list: "bullet" }], // Listas ordenadas e não ordenadas
    ["image"], // Inserir imagem
];

// Função para alterar a cor do placeholder
onMounted(() => {
    document
        .querySelector(".ql-editor")
        .setAttribute("data-placeholder", "Escreva algo...");
});
</script>

<style>
/* 🌙 Melhorado para modo escuro real */
.editor-container {
    background: #181818;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #333;
}

/* Ajuste da área de edição */
.custom-editor {
    background: #222;
    color: #fff;
    border-radius: 5px;
    padding: 10px;
    min-height: 200px;
}

/* Cor do placeholder alterada para branco */
.ql-editor::before {
    color: rgba(255, 255, 255, 0.6) !important;
}

/* 🛠️ Barra de ferramentas agora mais visível */
.ql-toolbar {
    background: #2a2a2a !important;
    border: 1px solid #444 !important;
    border-radius: 5px;
}

/* Ícones da barra de ferramentas com mais contraste */
.ql-toolbar button {
    color: #ddd !important;
    opacity: 0.8;
    transition: all 0.2s;
}

.ql-toolbar button:hover,
.ql-toolbar button.ql-active {
    background: #444 !important;
    opacity: 1;
}

/* Ajuste do container do editor */
.ql-container {
    background: #222 !important;
    color: #fff !important;
    min-height: 150px;
    border: 1px solid #444 !important;
    border-radius: 5px;
}

/* Ajuste para seleção de cor do texto */
.ql-picker {
    color: #ddd !important;
}

.ql-picker-label:hover {
    background: #444 !important;
}
</style>
