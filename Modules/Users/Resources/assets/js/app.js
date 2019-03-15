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

if (document.querySelector('#sign-up-form')) {
    
    var sign_up_form = new Vue({

        el: '#sign-up-form',
        data: {

            preloader: false,
            errorCode: null,
            formFields: [],
            erroValidate: false,
            referral: document.querySelector("input[name=referral]").value,

        },
        methods: {

            setData : function() {
                
                //url del store
                let url = '/new-account/store';
                //capturamos todos los campos de formulario
                const formData = new FormData(this.$refs['signUpForm']);
                const data = {};

                for (let [key, val] of formData.entries()) {

                    Object.assign(data, { [key]: val })
                }
                console.log(data);
                //validamos el formulario
                this.$validator.validateAll().then(() => {

                    if ( !this.errors.any() ) {

                        this.preloader = true;
                        this.errorCode = null;
                        this.erroValidate = false;

                        axios.post(SITE_URL + url,data).then((response) => {
                            //si se guarda correctamente el usuario
                            //cerramos el preloader y lanzamos al usuario a la siguiente página
                            this.preloader = false;
                            //dejamos un delay de medio 1/4 segundo
                            this.timeout = setTimeout( () => {

                                window.location.href = SITE_URL + "/new-account/resume-buy/"+response.data.remember_token;
                                
                            }, 250);

                            

                        }).catch(error => {
                            console.log(error);
                            this.errorCode = error.response;
                            this.preloader = false;
                            
                        });

                    }else{

                        this.erroValidate = true;
                    }

                });

            },
            setRegister: function() {
                //url del store
                let url = '/register-store';
                //capturamos todos los campos de formulario
                const formData = new FormData(this.$refs['signUpForm']);
                const data = {};

                for (let [key, val] of formData.entries()) {

                    Object.assign(data, { [key]: val })
                }
                //add referral
                Object.assign(data, { 'referral': this.referral });
                console.log(data);
                //validamos el formulario
                this.$validator.validateAll().then(() => {

                    if ( !this.errors.any() ) {

                        this.preloader = true;
                        this.errorCode = null;
                        this.erroValidate = false;

                        axios.post(SITE_URL + url,data).then((response) => {
                            //si se guarda correctamente el usuario
                            //cerramos el preloader y lanzamos al usuario a la siguiente página
                            this.preloader = false;
                            //dejamos un delay de medio 1/4 segundo
                            this.timeout = setTimeout( () => {
                                window.location.href = SITE_URL + "/register-end/" + response.data.id;
                            }, 250);

                        }).catch(error => {
                            console.log(error);
                            this.errorCode = error.response;
                            this.preloader = false;
                            
                        });

                    }else{

                        this.erroValidate = true;
                    }

                });
            }

        }

    });
}

/**
 * Componente para el listado de cursos del usuario
 * vincular, eliminar y listar
 * @param preloader --booleano, oculta o muestra el preload
 * @param errorCode --almacena errores de la consutla si tiene
 * @param erroValidate --booleano para la validación de campos de formulario
 * @param idUser --id del usuario
 * @param courses --vector, alamcena la colección de cursos
 */
if (document.querySelector('#course-collection')) {

    var course_collection = new Vue({

        el: '#course-collection',
        data: {

            preloader: false,
            errorCode: null,
            erroValidate: false,
            idUser: document.querySelector("input[name=iduser]").value,
            courses: [],
        },
        methods: {
            /**
             * consultamos si tiene cursos vinculados, y los cargamos
             * @param url --url para la consulta
             */
            _loadData() {

                this.preloader = true; 
                let url = '/courses/my-courses/' + this.idUser;

                axios.get(SITE_URL + url).then((response) => {
                    
                    this.preloader = false;
                    this.courses = response.data;

                }).catch(error => {
                    console.log(error);
                    this.errorCode = error.response;
                    this.preloader = false;
                    
                });
    
            }

        },
        mounted() {
            this._loadData();
        }

    });
    
}
