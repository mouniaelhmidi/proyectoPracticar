<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import Navbar from '@/Components/NavBar.vue'; 


const props = defineProps({
    offer: {
        type: Object,
        required: true,
    },

});

console.log(props.offer.categories.name);


//delete con axios 
const deleteOffer = (id) => {
    console.log('ID a eliminar:', id);
    console.log('Ruta generada:', route('offer.delete', { id }));

    if (confirm('¿Estás seguro de que deseas eliminar esta oferta?')) {
        axios.post(route('offer.delete', { id }))
            .then(() => {
                alert('Oferta eliminada correctamente.');
                window.location.href = '/offerlist'; // Redirigir a la lista después de eliminar
            })
            .catch((error) => {
                console.error('Error al eliminar la oferta:', error);
            });
    }
};

</script>

<template>

    <!-- 
    Margenes en todos los lados = m
    Margen derecha y izquierda = mx
    Margen arriba y abajo = my
    Margen arriba TOP = mt
    Margen abajo BOTTOM = mb
    Margen derecha LEFT = mr
    Margen izquierda RIGHT= ml

    p = padding(estapcio de arriba a bajo ),
    width (ancho, de derecha a izquierda) = w, w-screen(toda la pagina), w-min (minimo), w-max(maximo)
    height (alto, de arriba a abajo) = h, h-full(toda la pagina)
    background-color bg-black(negro)/ bg-white(blanco)/ los otros del 100 al 900: bg-blue-100 hasta bg-blue-900   

    color del texto: text-black, text-gray-50, text-gray-500
    opacidad del texto: text-opacity-0
    tamaño: text-xl, text-2xl
    aliniar texto: text-left, text-center, text-right, text-justify

    RESPONSIVE
        sm: Móviles grandes, tablets
        md: Tablets en horizontal
        lg: Laptops pequeños
        xl: Laptops grandes / desktops
        2xl: Monitores grandes
     
    flex = activa flexbox  
    flex-row = dirección horizontal // flex-col = dirección vertical  
    items-center = alinear vertical (eje cruzado) // justify-center = alinear horizontal (eje principal)  
    gap-4 = espacio entre elementos (interno)

    grid = activa grid layout  
    grid-cols-2 = 2 columnas // grid-cols-3, 4, 12... = columnas personalizadas  
    gap-4 = espacio entre filas/columnas

    border = borde simple  // border-2, border-4 = grosor  // border-red-500 = color  
    rounded   = bordes redondeados  // rounded-full = forma completamente redonda (círculo)

    TABLA
    `table-auto`: Ancho de tabla automático
    `table-fixed`: Ancho de tabla fijo
    `border-collapse`: Bordes colapsados
    `border-separate`: Bordes separados


    Hacer una tabla 

    -->
    <Navbar />


    <div class="p-10 ">
        <h1 class="text-2xl font-bold mb-4">Detalles de la Materia</h1>
        <div class="border p-4 rounded shadow mb-6 w-18 bg-blue-700">
            <p><strong>Nombre:</strong> {{ offer.name }}</p>
            <p><strong>Descripción:</strong> {{ offer.description || 'Sin descripción' }}</p>
            <p><strong>Categoria:</strong> {{ offer.categories.name }}</p>
        </div>

        <!-- botones editar y eliminar  -->
        <div class="flex flex-col md:flex-row justify-end mt-6 gap-4">
            <button class="btn-primary" role="button" tabindex="0" aria-label="Editar oferta">
                <a :href="`/offeredit/${offer.id}`" class="flex items-center">
                    <span>Editar</span>
                </a>
            </button>

            <button @click.prevent="deleteOffer(offer.id)" class="btn-danger" role="button" tabindex="0"
                aria-label="Eliminar libro">
                <span>Eliminar</span>
            </button>
        </div>


    </div>





</template>