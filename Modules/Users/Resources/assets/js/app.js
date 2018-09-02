const SITE_URL = document.head.querySelector('meta[name="site-url"]').content;
const MODULE_URL = document.head.querySelector('meta[name="module-url"]').content;
const METHOD = document.head.querySelector('meta[name="method"]').content;
//Multiselect
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.min.css';
Vue.component('multiselect', Multiselect);

/**
 * ---componente para el formulario Usuarios---
 * @param roles -- varialbe que almacena los roles seleccionados
 * *@param optRoles -- vector que contiene el listado de roles
*/
export default {
    components: { Multiselect },
    data () {
        return {
        roles: null,
        optRoles: ['list', 'of', 'options']
        }
    }
}

