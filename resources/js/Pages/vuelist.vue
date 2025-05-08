<script setup>
import { ref, computed } from 'vue';
import Navbar from '@/Components/NavBar.vue';

const props = defineProps({
    offers: Array,
    categories: Array
});

const searchQuery = ref('');

// // Obtener el nombre de la categoría por ID
const getCategoryName = (category) => {
    return category?.name || 'Sin categoría';
};

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
const filteredOffers = computed(() => {
    if (!searchQuery.value) return props.offers;

    return props.offers.filter(offer =>
        offer.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

</script>



<template>
    <Navbar />

    <div class="max-w-7xl mx-auto p-10">
        <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Lista de Ofertas</h1>

        <!-- Buscador -->
        <div class="mb-6">
            <label for="searchOffer" class="block text-sm font-medium text-blue-700 mb-1">Buscar Oferta</label>
            <input 
                id="searchOffer"
                type="text"
                v-model="searchQuery"
                class="w-full p-3 border border-blue-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Buscar por nombre, descripción o categoría"
            />
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
                        <td class="px-6 py-4 border-b">{{ offer.description || 'Sin descripción' }}</td>
                        <td class="px-6 py-4 border-b">{{ getCategoryName(offer.categories) }}</td>
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
    </div>
</template>


