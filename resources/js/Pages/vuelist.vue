<script setup>
import { ref, watch } from 'vue';
import Navbar from '@/Components/NavBar.vue';
import axios from "axios"; // Importar axios

const props = defineProps({
    offers: Object,
    categories: Array
});
console.log(props.offers);

//BUSCADOR CON LARAVEL
// const searchQuery = ref(''); 
// Obtener el nombre de la categoría por ID
// const getCategoryName = (category) => {
//     return category?.name || 'Sin categoría';
// };
// // Computed para filtrar ofertas según búsqueda buscando por nombre, descripción o categoría
// const filteredOffers = computed(() => {
//     if (!searchQuery.value) return props.offers;
//     return props.offers.filter(offer => 
//         offer.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
//         (offer.description && offer.description.toLowerCase().includes(searchQuery.value.toLowerCase())) ||
//         getCategoryName(offer.categories).toLowerCase().includes(searchQuery.value.toLowerCase())
//     );
// });
// Computed para filtrar ofertas según búsqueda buscando por nombre
// const filteredOffers = computed(() => {
//     if (!searchQuery.value) return props.offers;

//     return props.offers.filter(offer =>
//         offer.name.toLowerCase().includes(searchQuery.value.toLowerCase())
//     );
// });

//BUSCADOR Y PAGINACION CON AXIOS: 
// Variables reactivas
const filteredOffers = ref(props.offers?.data || []); // Si props.offers.data no está definido, usa un array vacío
const searchQuery = ref(""); // Valor del buscador
const selectedCategory = ref("all"); // Categoría seleccionada
const page = ref(1); // Página actual
const totalPages = ref(props.offers?.last_page || 1); // Total de páginas

// Función para cargar ofertas con filtros y paginación
const reloadOffers = () => {
    console.log("Cargando ofertas...");
    axios.get("/offers/filter", {
        params: {
            search: searchQuery.value,
            category: selectedCategory.value,
            page: page.value,
        },
    })
    .then((response) => {
        console.log("Respuesta del servidor:", response.data);
        filteredOffers.value = response.data.data;
        totalPages.value = response.data.last_page;
    })
    .catch((error) => {
        console.error("Error al cargar las ofertas:", error);
    });
};
// Observador para recargar datos
watch([searchQuery, selectedCategory, page], () => {
    reloadOffers();
    console.log("Ofertas filtradas:", filteredOffers.value);
});
</script>

<template>
    <Navbar />

    <div class="max-w-7xl mx-auto p-10">
        <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Lista de Ofertas</h1>

        <!-- Filtros -->
        <div class="mb-6 flex flex-col md:flex-row gap-4">
            <!-- Buscador -->
            <div class="flex-1">
                <label for="searchOffer" class="block text-sm font-medium text-blue-700 mb-1">Buscar Oferta</label>
                <input
                    id="searchOffer"
                    type="text"
                    v-model="searchQuery"
                    class="w-full p-3 border border-blue-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Buscar por nombre o descripción"
                />
            </div>

            <!-- Selector de Categoría -->
            <div class="flex-1">
                <label for="categorySelector" class="block text-sm font-medium text-blue-700 mb-1">Categoría</label>
                <select
                    id="categorySelector"
                    v-model="selectedCategory"
                    class="w-full p-3 border border-blue-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="all">Todas las categorías</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto rounded-lg shadow-md border border-blue-200 bg-white">
            <table class="min-w-full table-auto text-sm text-left text-blue-900">
                <thead class="bg-blue-100 text-blue-700">
                    <tr>
                        <th class="px-6 py-3 border-b">Nombre</th>
                        <th class="px-6 py-3 border-b">Descripción</th>
                        <th class="px-6 py-3 border-b">Categoría</th>
                        <th class="px-6 py-3 border-b text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="offer in filteredOffers" :key="offer.id" class="hover:bg-blue-50">
                        <td class="px-6 py-4 border-b">{{ offer.name }}</td>
                        <td class="px-6 py-4 border-b">{{ offer.description || "Sin descripción" }}</td>
                        <td class="px-6 py-4 border-b">{{ offer.category?.name }}</td>
                        <td class="px-6 py-4 border-b text-center">
                            <a
                                :href="`/offer/${offer.id}`"
                                class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                            >
                                Ver Detalles
                            </a>
                        </td>
                    </tr>
                    <tr v-if="filteredOffers.length === 0">
                        <td colspan="4" class="text-center py-6 text-gray-500">No se encontraron ofertas.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center mt-6">
            <button
                v-for="pageNumber in totalPages"
                :key="pageNumber"
                @click="page = pageNumber"
                :class="[
                    'px-4 py-2 mx-1 border rounded',
                    page === pageNumber ? 'bg-blue-500 text-white' : 'bg-white text-blue-500',
                ]"
            >
                {{ pageNumber }}
            </button>
        </div>
    </div>
</template>