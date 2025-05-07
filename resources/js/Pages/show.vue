<script setup>
import { defineProps } from 'vue';

// Recibir los datos del libro como una propiedad
const props = defineProps({
    book: {
        type: Object,
        required: true,
    },
});

//funcion delete
const deleteBook = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este libro?')) {
        axios.delete(route('book.delete', { id: id }))
            .then(response => {
                console.log(response.data.message);
                window.location.href = '/addbook'; // Redirigir después de eliminar
            })
            .catch(error => {
                console.error('Error al eliminar el libro:', error);
            });
    }
};
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Detalles del Libro</h1>
        <div class="border p-4 rounded shadow">
            <p><strong>Título:</strong> {{ book.title }}</p>
            <p><strong>Autor:</strong> {{ book.author }}</p>
            <p><strong>Género:</strong> {{ book.genre }}</p>
            <p><strong>Editorial:</strong> {{ book.publisher }}</p>
        </div>


        <div class="flex flex-col md:flex-row justify-end mt-6 gap-4">
            <button class="btn-primary" role="button" tabindex="0" aria-label="Editar oferta">
                <a :href="`/bookedit/${book.id}`" class="flex items-center">
                    <span>Editar</span>
                </a>
            </button>
            
            <button @click.prevent="deleteBook(book.id)" class="btn-danger" role="button" tabindex="0"
                aria-label="Eliminar libro">
                <span>Eliminar</span>
            </button>
        </div>


        <div class="mt-4">
            <a href="/" class="text-blue-500 hover:underline">Volver a la lista</a>
        </div>
    </div>
</template>