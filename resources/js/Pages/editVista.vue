<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, computed } from 'vue';
import Navbar from '@/Components/NavBar.vue'; 



//el props
const props = defineProps({
    teachers: {
        type: Array,
        required: true,
    },
    subjects: {
        type: Object,
        required: true,
    },
});


// Manera 1 para precargar los datos 
// const form = useForm({
//     id: props.subjects.id,
//     name: props.subjects.name,
//     description: props.subjects.description,
//     teacher_id: props.subjects.teacher_id,
// });


// Manera 2 para precargar los datos primero el useForm y despues el onMounted
const form = useForm({
    id: '',
    name: '',
    description: '',
    teacher_id: '',
});
// el onMounted para precargar los campos 
onMounted(() => {
    form.id = props.subjects.id;
    form.name = props.subjects.name;
    form.description = props.subjects.description;
    form.teacher_id = props.subjects.teacher_id;
    
});


// Función para enviar el formulario
const updateMateria = () => {
   form.put(route('ruta.update', { id: form.id }));
}

</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Formulario para editar Materia</h1>
        <!-- Inicio del formulario -->
        <form @submit.prevent="updateMateria" enctype="multipart/form-data">
            <!-- Campo Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="form.name" type="text" id="name"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el nombre de la materia" required />
            </div>

            <!-- Campo Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea v-model="form.description" id="description"
                    class="border p-2 rounded w-full" placeholder="Escribe una descripción"></textarea>
            </div>


            <!-- Campo Profesor -->
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700">Profesor</label>
                <select v-model="form.teacher_id" id="teacher_id" class="border p-2 rounded w-full h-10" required>
                    <option value="" disabled>Selecciona un profesor</option>
                    <option v-for="teacher in teachers" :key="teacher.id" :value="teacher.id">
                        {{ teacher.name }} {{ teacher.surname }}
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