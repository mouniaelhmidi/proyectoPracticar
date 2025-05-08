<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/Components/NavBar.vue'; 
import Footer from '@/Components/Footer.vue'; // 👈 Importa el footer

defineProps({
    user: {
        type: Object,
        required: false,
    },
});
</script>

<template>
    <Navbar />
    <Head title="Home" />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 flex flex-col justify-between">
        
        <!-- Hero Section -->
        <header class="bg-white wite:bg-gray-800 py-20 shadow-md">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h1 class="text-5xl font-extrabold text-gray-900 dark:text-dark">
                    Bienvenido a Mi Proyecto
                </h1>
                <p class="mt-4 text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Explora nuestras ofertas y categorías para encontrar lo que necesitas.
                </p>
                <div class="mt-8">
                    <Link
                        href="/offerlist"
                        class="inline-block px-8 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition"
                    >
                        Ver Ofertas
                    </Link>
                </div>
            </div>
        </header>

        <!-- Footer separado -->
        <Footer />
    </div>
</template>
