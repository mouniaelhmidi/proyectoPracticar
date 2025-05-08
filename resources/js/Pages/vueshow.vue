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

    <template>
        <Navbar />
    
        <div class="max-w-3xl mx-auto p-8 mt-10 bg-blue-50 rounded-xl shadow-md">
            <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">
                Detalles de la Oferta
            </h1>
    
            <!-- Tarjeta de información -->
            <div class="bg-white border border-blue-300 rounded-lg p-6 shadow space-y-4">
                <p><strong class="text-blue-700">Nombre:</strong> {{ offer.name }}</p>
                <p><strong class="text-blue-700">Descripción:</strong> {{ offer.description || 'Sin descripción' }}</p>
                <p><strong class="text-blue-700">Categoría:</strong> {{ offer.categories.name }}</p>
            </div>
    
            <!-- Botones -->
            <div class="flex flex-col md:flex-row justify-end gap-4 mt-8">
                <a
                    :href="`/offeredit/${offer.id}`"
                    class="inline-block px-6 py-2 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 transition font-semibold text-center"
                    role="button"
                    aria-label="Editar oferta"
                >
                    Editar
                </a>
    
                <button
                    @click.prevent="deleteOffer(offer.id)"
                    class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition font-semibold"
                    role="button"
                    aria-label="Eliminar oferta"
                >
                    Eliminar
                </button>
            </div>
        </div>
    </template>
    