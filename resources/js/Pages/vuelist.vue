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

    <div class="p-10">
        <h1 class="text-2xl font-bold mb-4">Lista de Ofertas</h1>
        <!-- Buscador -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="searchOffer">Buscar</label>
            <input 
                aria-label="searchOffer"
                id="searchOffer"
                type="text"
                v-model="searchQuery"
                class="w-full border-2 border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Buscar por nombre, descripción o categoría"
            />
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-300 text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2">Descripción</th>
                        <th class="border border-gray-300 px-4 py-2">Categoría</th>
                        <th class="border border-gray-300 px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="offer in filteredOffers" :key="offer.id">
                        <td class="border border-gray-300 px-4 py-2">{{ offer.name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ offer.description || 'Sin descripción' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ getCategoryName(offer.categories) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a :href="`/offershow/${offer.id}`" class="text-blue-500 hover:underline">Ver Detalles</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

