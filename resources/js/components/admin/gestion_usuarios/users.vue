<template>
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-wrap w-150px">
                                    <select v-model="criterio" class="form-control " data-search="off" data-placeholder="Bulk Action">
                                        <option value="nombres">Nombre</option>
                                        <option value="ap_paterno">Apellido Paterno</option>
                                        <option value="ap_materno">Apellido Materno</option>
                                        <option value="email">Email</option>
                                        <option value="nr_rut">Rut</option>
                                        <option value="last_login">Último Inicio Sesión</option>
                                    </select>
                                </div>
                                <div class="btn-wrap">
                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                </div>
                            </div><!-- .form-inline -->
                        </div><!-- .card-tools -->
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li><!-- li -->
                                                <!-- li -->
                                                <li >
                                                    <a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-setting"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Show</span></li>
                                                                <li :class="{'active':nr_show ==10}" @click="setShow(10)"><a href="#">10</a></li>
                                                                <li :class="{'active':nr_show ==20}" @click="setShow(20)"><a href="#">20</a></li>
                                                                <li :class="{'active':nr_show ==50}" @click="setShow(50)"><a href="#">50</a></li>
                                                            </ul>
                                                            <ul class="link-check">
                                                                <li><span>Order</span></li>
                                                                <li :class="{'active':orderBy == 'DESC'}" @click="setOrder('DESC')"><a href="#">DESC</a></li>
                                                                <li :class="{'active':orderBy == 'ASC'}" @click="setOrder('ASC')"><a href="#">ASC</a></li>
                                                            </ul>
                                                        </div>
                                                    </div><!-- .dropdown -->
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div><!-- .toggle-wrap -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- .card-tools -->
                    </div><!-- .card-title-group -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input @keyup.enter="getUsers()" v-model="busqueda" type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                
                            </div>
                            <div class="nk-tb-col"><span class="sub-text">Usuario</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Rut</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Unidad</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Depto</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Telefono</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Rol</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Último Inicio de Sesión</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Estado</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Opciones</span></div>
                            
                        </div><!-- .nk-tb-item -->
                        <div class="nk-tb-item" v-for="(user,index) in users" :key="index">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" :id="'uid'+index">
                                    <label class="custom-control-label" :for="'uid'+index"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-avatar" :style="{ background: user.roles[0].color }">
                                            <span>{{ user.letters }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ user.nombres+' '+user.ap_paterno+' '+user.ap_materno }} <span class="dot dot-success d-md-none ms-1"></span></span>
                                            <span>{{ user.email }}</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="nk-tb-col tb-col-mb" style="min-width: 100px;">
                                <span class="tb-amount">{{ user.nr_rut }} </span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{ user.unidad.nombre }} </span>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span v-if="user.depto" class="tb-amount">{{ user.depto.nombre }} </span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-amount">{{ user.celular}}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <ul class="list-status">
                                    <li> <span class="tb-amount">{{ user.roles[0].name }}</span></li>
                                </ul>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                <span class="tb-amount"> {{ user.last_login }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span v-if="user.tp_activo == 1" class="tb-status text-success">Activo</span>
                                <span v-else class="tb-status text-danger">Desactivado</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li @click="showModal(1,user)"><a href="#"><em class="icon ni ni-eye"></em><span>Ver</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Editar</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
                                                    <li v-if="user.tp_activo == 1"><a href="#"><em class="icon ni ni-na"></em><span>Suspender User</span></a></li>
                                                    <li v-else><a href="#"><em class="icon ni ni-na"></em><span>Activar User</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
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
                        </div>
                       
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->

    <!-- Modal Trigger Code -->
    <!-- Detalle Usuario-->
    <user_detalle :init="init" :user="tmp_user"></user_detalle>
    
    
</template>

<script>
import axios from 'axios';
import user_detalle from './user_detalle.vue';

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
            offset                     : 3,
            unidades        : [],
            deptos          : [],
            secciones       : [],
            init            : []

        }
    },
    components: {
        user_detalle
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
        setShow(cant)
        {
            let me = this;
            me.nr_show = cant
            me.getUsers()
        },
        cambiarPagina(page)
        {
            let me = this;
            me.pagination.current_page = page;
            me.getUsers(page,cant);
        },
        getUsers() {
            let me = this;
            let ruta = '/users?page=' + me.pagination.current_page+'&cant='+me.nr_show+'&orderBy='+me.orderBy+'&criterio='+me.criterio+'&busqueda='+me.busqueda;

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
        showModal(tp_modal = 1,usuario)
        {
            let me = this;

            me.tmp_user = usuario;
            me.tp_modal = tp_modal;

            if(tp_modal == 1)
                $("#modalUser").modal('show');
            
        },
        
    },
    mounted(){

        this.getUsers();
        this.getInit();
       
    }
}
</script>