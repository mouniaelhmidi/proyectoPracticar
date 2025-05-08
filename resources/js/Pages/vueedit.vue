<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Navbar from '@/Components/NavBar.vue'; 

//el props
const props = defineProps({
    offer: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

// // Inicializar el formulario con los campos requeridos
const form = useForm({
    id: '',
    name: '',
    description: '',
    category_id: '',
});
onMounted (() => {
    // Aquí puedes cargar datos iniciales si es necesario
    form.id = props.offer.id;
    form.name = props.offer.name;
    form.description = props.offer.description;
    form.category_id = props.offer.category_id;
});

// Función para guardar la materia
const updateOffer = () => {
    form.put(route('offer.update', { id: form.id }));
}

</script>

<template>
    <Navbar />

    <div>
        <h1 class="text-2xl font-bold mb-4">Formulario para añadir oferta</h1>
        <!-- Inicio del formulario -->
        <form @submit.prevent="updateOffer" enctype="multipart/form-data">
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