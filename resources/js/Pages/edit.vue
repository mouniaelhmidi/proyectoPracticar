<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Recibir los datos del libro como una propiedad
const props = defineProps({
    book: {
        type: Object,
        required: true,
    },
});

// Inicializar el formulario con los datos del libro
const form = useForm({
    id: props.book.id,
    title: props.book.title,
    author: props.book.author,
    genre: props.book.genre,
    publisher: props.book.publisher,
});



// Función para enviar el formulario
const updateBook = () => {
   form.put(route('book.update', { id: form.id }));
}
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Editar Libro</h1>
        <form @submit.prevent="updateBook" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input v-model="form.title" type="text" id="title" class="border p-2 rounded w-full" required />
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input v-model="form.author" type="text" id="author" class="border p-2 rounded w-full" />
            </div>
            <div>
                <label for="genre" class="block text-sm font-medium text-gray-700">Género</label>
                <input v-model="form.genre" type="text" id="genre" class="border p-2 rounded w-full" />
            </div>
            <div>
                <label for="publisher" class="block text-sm font-medium text-gray-700">Editorial</label>
                <input v-model="form.publisher" type="text" id="publisher" class="border p-2 rounded w-full" />
            </div>
            <!-- Botón Guardar -->
            <div class="col-span-2 flex justify-end mt-4">
                <button type="submit"
                class="border border-red-300 bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                Guardar libro
                </button>
            </div>
        </form>
    </div>
</template>