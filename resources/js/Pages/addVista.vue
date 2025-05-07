<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

// Inicializar el formulario con los campos requeridos
const form = useForm({
    name: '',
    description: '',
    category_id: '',
    teacher_id: '',
});

//el props
const props = defineProps({
    teachers: {
        type: Array,
        required: true,
    },
});

// Función para guardar la materia
function save() {
   console.log(form);
   form.post(route("ruta.save"));
}

</script>

<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Formulario para añadir Materia</h1>
        <!-- Inicio del formulario -->
        <form @submit.prevent="save" enctype="multipart/form-data">
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

            <!-- Campo Categoría -->
            <!-- <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Categoría</label>
                <input v-model="form.category_id" type="text" id="category_id"
                    class="border p-2 rounded w-full h-10" placeholder="Escribe el ID de la categoría" />
            </div> -->

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