<script setup>

import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// el CONST FORM
const form = useForm({
    title: '',
    author: '',
    genre: '',
    publisher: '',

});

// FUNCION DE GUARDAR
function save() {
   console.log(form);
   form.post(route("save.book"));
}

</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4 black">Formulario para añadir un libro</h1>
        <!-- inicio del form-->
        <form @submit.prevent="save" enctype="multipart/form-data">
            <!-- Campo Titulo -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                <input v-model="form.title" type="text" id="title"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el título del libro" required />
            </div>

            <!-- Campo Autor -->
            <div class="mt-4">
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input v-model="form.author" type="text" id="author"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el autor del libro" />
            </div>

            <!-- Campo Género -->
            <div class="mt-4">
                <label for="genre" class="block text-sm font-medium text-gray-700">Género</label>
                <input v-model="form.genre" type="text" id="genre"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el género del libro" />
            </div>

            <!-- Campo publisher -->
            <div class="mt-4">
                <label for="publisher" class="block text-sm font-medium text-gray-700">publisher</label>
                <input v-model="form.publisher" type="text" id="publisher"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el género del libro" />
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