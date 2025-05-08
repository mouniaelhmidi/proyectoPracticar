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
    <div>
        <h1 class="text-2xl font-bold mb-4">Formulario para añadir oferta</h1>
        <!-- Inicio del formulario -->
        <form @submit.prevent="save" enctype="multipart/form-data">
            <!-- Campo Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="form.name" type="text" id="name"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el nombre de la materia" required />
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripcion</label>
                <input v-model="form.description" type="text" id="name"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el nombre de la materia" required />
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Profesor</label>
                <select v-model="form.category_id" id="teacher_id" class="border p-2 rounded w-full h-10" required>
                    <option value="" disabled>Selecciona una categoria</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }} 
                    </option>
                </select>
            </div>
            <!-- Botón Guardar -->
            <div class="col-span-2 flex justify-end mt-4">
                <button type="submit"
                    class="border border-red-300 bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">
                    Guardar Materia
                </button>
            </div>
        </form>
    </div>
</template>