<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import Navbar from '@/Components/NavBar.vue';
import Footer from '@/Components/Footer.vue';

defineProps({
    user: {
        type: Object,
        required: false,
    },
});

const cookiesAccepted = ref(false);

if (localStorage.getItem("cookies") === "true") {
    cookiesAccepted.value = true;
}

const acceptCookies = () => {
    cookiesAccepted.value = true;
    localStorage.setItem("cookies", "true");
}
// const index = ref(0);

// const textos = [
//   'Benvingut al nostre projecte!',
//   'Explora les funcionalitats disponibles.',
//   'Recorda desar els teus progressos.',
//   'Gracies per visitar-nos!'
// ];

// const next = () => {
//   index.value = (index.value + 1) % textos.length;
// };

// const prev = () => {
//   index.value = (index.value - 1 + textos.length) % textos.length;
// };
</script>

<template>
    <Navbar />

    <Head title="Home" />

    <div
        class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 flex flex-col justify-between">

        <!-- <div class="w-full max-w-xl mx-auto p-4">
            <div class="relative">
                <p class="text-center">{{ textos[index] }}</p>

                <div class="absolute top-1/2 left-0 transform -translate-y-1/2">
                    <button @click="prev" class="bg-white px-2 py-1 rounded shadow">←</button>
                </div>

                <div class="absolute top-1/2 right-0 transform -translate-y-1/2">
                    <button @click="next" class="bg-white px-2 py-1 rounded shadow">→</button>
                </div>
            </div>

            <div class="flex justify-center gap-2 mt-2">
                <span v-for="(s, i) in slides" :key="i" class="w-2 h-2 rounded-full"
                    :class="i === index ? 'bg-black' : 'bg-gray-400'"></span>
            </div>
        </div> -->
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
                    <Link href="/offerlist"
                        class="inline-block px-8 py-3 bg-red-600 text-white font-semibold rounded-lg shadow-md hover:bg-red-700 transition">
                    Ver Ofertas
                    </Link>
                </div>
            </div>
        </header>

        <div v-if="!cookiesAccepted" class="bg-black/80 absolute min-w-full min-h-full z-40 start-0 top-0 flex justify-center items-center">
            <div class="w-1/2 min-h-[180px] bg-green-200 border-b-4 rounded-lg shadow-md border-b-green-800 p-4">
                <h2 class="text-green-800 text-4xl font-extrabold">Avís de cookies</h2>
                <p class="text-black">Aquesta web no fa servir cookies pero et mostro un avís perque soc bona gent! :)</p>
                <br>
                <div class="inline-flex justify-end w-full text-black">
                    <button @click="acceptCookies" >Ok</button>
                </div>
            </div>
        </div>

        <!-- Footer separado -->
        <Footer />
    </div>
</template>
