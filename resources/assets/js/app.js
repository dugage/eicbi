
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//Vuejs Dialog Plugin
import VuejsDialog from "vuejs-dialog";
import VuejsDialogMixin from "vuejs-dialog/dist/vuejs-dialog-mixin.min.js";
import 'vuejs-dialog/dist/vuejs-dialog.min.css';

Vue.use(VuejsDialog, {
    html: true, 
    loader: false,
    okText: 'Continuar',
    cancelText: 'Cancelar',
    animation: 'bounce'
});


/**
 * ---componente la tabla con listados de candidates---
*/
if (document.querySelector('#table-data')) {

    const SITE_URL = document.head.querySelector('meta[name="site-url"]').content;
    const MODULE_URL = document.head.querySelector('meta[name="module-url"]').content;
   
    var table_managers = new Vue({

        el: '#table-data',
        data: {

            preloader: false,
            errorCode: null,
            showModal: false,
            rows: [],
            editUrl: '',
            deleteUrl: '',
            showUrl: '',
            pageItem: null,
            searchParam:'',
            timeout: null,
        },
        methods: {
            //método para la búsqueda
            getDataBySearchParam : function() {

                if (this.timeout != null) {
                    clearTimeout(this.timeout);
                }

                this.timeout = setTimeout( () => {
                    this.timeout = null;

                    let url = this.searchParam ? '/'+MODULE_URL+'/search/' + this.searchParam : '/'+MODULE_URL;
                    //si el parametro es vacío loadData sin param
                    url != '' ?  this._loadData(url) : this._loadData();
                }, 500);

            },
            //metodo para la paginación
            getDataByPage : function(page) {

                let url = '/'+MODULE_URL+'?page=' + page;
                this._loadData(url);
            },
             //metodo para la confirmación de acciones
             confirmationDialog : function(text,url=null) {

                this.$dialog.confirm(text)
                .then(function (dialog) {

                    location.href =url;

                })
                .catch(function () {

                    console.log('Clicked on cancel');

                });
            },
            //limpia la url para los btn edit y delete
            _clearModuleUrl(moduleUrl){

                let module = moduleUrl.split('/');
                (module.length > 1) ? module = module[1] : module = module[0];
                return module;
            },
            //metodo para la confirmación de acciones
            confirmationDialog : function(text,url=null) {

                this.$dialog.confirm(text)
                .then(function (dialog) {

                    location.href =url;

                })
                .catch(function () {

                    console.log('Clicked on cancel');

                });
            },
            //metodo que carga la tabla al inicio de la página
            _loadData(urlPage = null) {
                //url del método
                this.preloader = true; 
                let url = '/'+MODULE_URL;
                //si urlPage es distintao de null sobreescribimos url
                if( urlPage != null)
                    url = urlPage;

                axios.get(SITE_URL + url).then((response) => {

                    this.preloader = false;
                    this.rows = response.data;
                    //this.pageItem = this._getPageItem(response.data);
                    this.editUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/edit/';
                    this.deleteUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/delete/';
                    this.showUrl = SITE_URL + '/'+this._clearModuleUrl(MODULE_URL)+'/show/';
                    
                }).catch(error => {

                    this.errorCode = error.response;
                    this.preloader = false;
                    this.showModal = true;
                });
            },
        },
        mounted() {
            this._loadData();
        },
    });

}

/**
 * ---componente para interactuar con los formularios---
*/
if (document.querySelector('#form-data')) {
alert();
}