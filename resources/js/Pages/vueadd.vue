<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/NavBar.vue'; 


// // Inicializar el formulario con los campos requeridos
const form = useForm({
    name: '',
    description: '',
    category_id: '',
});

// //el props
const props = defineProps({
    offers: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

// // Función para guardar la materia
function save() {
   console.log(form);
   form.post(route("offer.save"));
}

</script>
<template>
    <Navbar />

    <div class="max-w-3xl mx-auto p-8 mt-10 bg-blue-200 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">
            Añadir Nueva Oferta
        </h1>

        <form @submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
            
            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-blue-700 mb-1">
                    Nombre
                </label>
                <input 
                    v-model="form.name" 
                    type="text" 
                    id="name"
                    placeholder="Escribe el nombre de la oferta"
                    class="w-full border border-blue-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white"
                    required
                />
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-blue-700 mb-1">
                    Descripción
                </label>
                <input 
                    v-model="form.description" 
                    type="text" 
                    id="description"
                    placeholder="Breve descripción de la oferta"
                    class="w-full border border-blue-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white"
                    required
                />
            </div>

            <!-- Categoría -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-blue-700 mb-1">
                    Categoría
                </label>
                <select 
                    v-model="form.category_id" 
                    id="category_id"
                    class="w-full border border-blue-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none bg-white"
                    required
                >
                    <option value="" disabled>Selecciona una categoría</option>
                    <option 
                        v-for="category in categories" 
                        :key="category.id" 
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <!-- Botón -->
            <div class="text-right">
                <button
                    type="submit"
                    class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-700 transition"
                >
                    Guardar Oferta
                </button>
            </div>
        </form>
    </div>
</template>
