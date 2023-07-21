<template>
    <table class="table table-sm table-bordered">
        <thead class="bg-primary text-white text-center" style="border: 1px solid white">
            <tr >
                <th colspan="8">Usuarios</th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Rut</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item) in users" :key="item.id">
                <td>{{ item.nombres }}</td>
                <td>{{ item.ap_paterno }}</td>
                <td>{{ item.ap_materno }}</td>
                <td>{{ item.nr_rut }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.celular }}</td>
                <td>{{ item.roles[0].name }}</td>
                <td>
                    <button @click="showModal(1,item)" class="btn btn-xs btn-info">Ver</button>
                </td>
            </tr>
        </tbody>
    </table>
    
    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            <ul class="pagination justify-content-center justify-content-md-start">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                </li>
            </ul><!-- .pagination -->
            
        </div><!-- .nk-block-between -->
    </div>
    
    <user_detalle @callApi="testUpdateUser()" :init="init" :user="tmp_user"></user_detalle>
    <user_create :init="init"> </user_create>    

    
    
</template>

<script>
import axios from 'axios';
//componentes propios
import user_detalle from './user_detalle.vue';
import user_create from './user_create.vue'

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
window.toastr = toastr;

export default {
    data() {
        return {
            tmp_user        : [],
            tp_modal        : 0,
            criterio        : 'nombres',
            busqueda        : '',
            users           : [],
            nr_show         : 10, // cantidad de elementos a mostrar en paginate
            orderBy         : 'ASC',
            pagination      : {
                                'total' : 0,
                                'current_page' : 0,
                                'per_page' : 0,
                                'last_page' : 0,
                                'from' : 0,
                                'to' : 0,
                            },
            offset          : 3,
            unidades        : [],
            deptos          : [],
            secciones       : [],
            init            : []

        }
    },
    components: {
        user_detalle,
        user_create
    },
    computed:{

        isActived: function(){
            return this.pagination.current_page;
        },
        //Calcula los elementos de la paginación
        pagesNumber: function() 
            {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;

            }
},
    methods: {
        
        testUpdateUser()
        {
            this.getUsers();
            
        },
        getInit()
        {
            let me = this;
            let ruta = '/init'

            axios.get(ruta)
                .then(response => 
                {
                    let tmp_init   = response.data.unidades;
                    let roles      = response.data.roles;

                    this.unidades = tmp_init.map(unidad => ({
                        id: unidad.id,
                        nombre: unidad.nombre,
                        deptos: unidad.deptos
                        }));

                    this.unidades.forEach(unidad => {
                        unidad.deptos.forEach(depto => 
                            {
                                this.deptos.push({
                                    id: depto.id,
                                    nombre: depto.nombre,
                                    nr_unidad: depto.nr_unidad
                                    });
                            });
                        });

                    this.unidades.forEach(unidad => {
                        unidad.deptos.forEach(depto => {
                            depto.secciones.forEach(seccion => {
                                this.secciones.push({
                                    nr_unidad: seccion.nr_unidad,
                                    id: seccion.id,
                                    nr_depto: depto.id,
                                    nombre: seccion.nombre
                                });
                            });
                        });
                    });

                    this.init = {
                        unidades    : this.unidades,
                        deptos      : this.deptos,
                        secciones   : this.secciones,
                        roles       : roles
                    }
                           
                
                })
                .catch(error => {
                    console.log(error)
                })
        },
        setOrder(order)
        {
            let me = this;
            me.orderBy = order;
            me.getUsers()
        },
        
        cambiarPagina(page)
        {
            let me = this;
            me.pagination.current_page = page;
            me.getUsers(page);
        },
        getUsers() {
            let me = this;
            let ruta = '/users?page=' + me.pagination.current_page+'&cant=15'+'&orderBy='+me.orderBy+'&criterio='+me.criterio+'&busqueda='+me.busqueda;

            axios.get(ruta)
                .then(response => 
                {
                    let respuesta   = response.data;
                    me.users        = respuesta.users.data;
                    me.pagination   = respuesta.pagination;
                })
                .catch(error => {
                    console.log(error)
                })
            
        },
        showModal(tp_modal = 1,usuario= {})
        {
            let me = this;

            me.tp_modal = tp_modal;

            if(tp_modal == 1)
                {
                    $("#modalUser").modal('show');
                    me.tmp_user = usuario;

                }
            
            
            if(tp_modal == 2)
                $("#modalCreateUser").modal('show');
            
        },
        
    },
    mounted(){

        this.getUsers();
        this.getInit();
       
    }
}
</script>