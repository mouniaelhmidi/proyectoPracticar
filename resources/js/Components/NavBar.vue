<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
  <nav class="w-full bg-red-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <!-- Logo -->
        <div class="flex-shrink-0 flex items-center">
          <Link href="/" class="text-xl font-bold">Borsa Cendrassos</Link>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden sm:flex sm:items-center space-x-6">
          <Link href="/addoffer" class="hover:text-gray-200">Afegir Oferta</Link>
          <Link href="/offerlist" class="hover:text-gray-200">Llistar Ofertes</Link>
          <Link href="/login" class="hover:text-gray-200">Iniciar Sessió</Link>
        </div>

        <!-- Hamburger Button -->
        <div class="sm:hidden flex items-center">
          <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                v-if="!showingNavigationDropdown"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="sm:hidden bg-red-800 px-4 pt-2 pb-4">
      <Link href="/addoffer" class="block py-2 text-sm hover:text-gray-300">Afegir Oferta</Link>
      <Link href="/offerlist" class="block py-2 text-sm hover:text-gray-300">Llistar Ofertes</Link>
      <Link href="/login" class="block py-2 text-sm hover:text-gray-300">Iniciar Sessió</Link>
    </div>
  </nav>
</template>
