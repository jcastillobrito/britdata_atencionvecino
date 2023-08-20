<template lang="">

    <div class="row-fluid">
        <div class="card card-bordered card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem5">
                    <em class="icon ni ni-user"></em><span>Servicios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem6">
                    <em class="icon ni ni-growth"></em><span>Métricas</span>
                    </a>
                </li>
                
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tabItem5">
                    <button  class="btn btn-sm btn-success my-1" style="float:right">
                        Crear Servicios
                    </button>
                    <table class="table table-sm table-bordered table-responsive">
                        <thead class="bg-primary  text-white text-center"  style="border: 1px solid white">
                            <tr>
                                <th colspan=8>Servicios</th>
                            </tr>
                            <tr>
                                <th>Servicio</th>
                                <th>Descripción</th>
                                <th>Unidad</th>
                                <th>Depto</th>
                                <th>Respuesta Automatica</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in servicios">
                                <td>{{item.nombre}}  
                                    <span class="badge  rounded-pill" :class="{'bg-danger': item.usuarios_count === 0, 'bg-success': item.usuarios_count > 0}" title="Cantidad Integrantes">{{item.usuarios_count }}</span> 
                                </td>
                                <td>{{item.descripcion_servicio}} </td>
                                <td>{{item.unidad.nombre}}</td>
                                <td>{{item.depto.nombre}}</td>
                                <td>{{ item.tp_resp_automatica ? 'Si' : 'No' }} </td>
                                <td>{{ item.tp_activo ? 'Habilitado' : 'Desactivado' }}</td>
                                <td>
                                    <div class="btn-group dropright">
                                        <button type="button" class="btn btn-primary  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">Acciones</button>
                                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                                            <em class="icon ni ni-chevron-down"></em>
                                            <span class="visually-hidden">Toggle Dropright</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <ul class="link-list-plain">
                                                <li @click="showModal('#modal_generico',item,'modal_responsables')"><a href="#"><em class="icon ni ni-users"></em><span>Responsables</span></a></li>
                                                <li><a href="#"> <em class="icon ni ni-edit-alt"></em><span>Editar</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-trash-alt"></em><span>Deshabilitar</span></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table> 
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane " id="tabItem6">
                    test 2
                </div>
            </div>

        </div>
    </div>
  
    </div>

    <div class="modal" tabindex="-1" id="modal_generico">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{modal_title}} </h5> &nbsp; <span class="badge  rounded-pill" :class="{'bg-danger': tmp_user.length === 0, 'bg-info': tmp_user.length > 0}" title="Cantidad Integrantes">{{tmp_user.length }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"> 
                <div v-if="modal_activo == 'modal_responsables'">

                    <ol class="list-group list-group-numbered">
                       <div v-for="user in tmp_user">
                            <li  v-if="user.tp_activo"  class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{user.users.nombres+' '+user.users.ap_paterno+' '+user.users.ap_materno}}
                                    </div>
                                    <span v-if="user.users.depto">{{ user.users.depto.nombre}}</span> <br>
                                    <i v-if="user.users.email">{{ user.users.email}}</i>
                                </div>
                                <button @click="changeStatus(user.id_user,3,user.tp_responsable,user.id_service)" class="btn btn-xs btn-success mx-1" :class="user.tp_responsable == 1? 'btn-success':'btn-danger'" title="Responsable de Servicio">
                                    <em class="icon ni ni-user-list-fill"></em>
                                </button>
                                <button @click="changeStatus(user.id_user,1,user.tp_respuesta_final,user.id_service)"  :class="user.tp_respuesta_final == 1? 'btn-success':'btn-danger'"  class="btn btn-xs  mx-1" title="Permiso Respuesta Final">
                                    <em class="icon ni ni-edit-fill"></em>
                                </button>
                                <button @click="changeStatus(user.id_user,0,user.tp_activo,user.id_service)" class="btn btn-xs btn-secondary mx-1" title="Quitar">
                                    <em class="icon ni ni-file-remove-fill"></em>
                                </button>
                            </li>      
                       </div>                  
                    </ol>

                    <VueMultiselect 
                        class="mt-3"
                        v-model="select_users"
                        :options="options_users"
                        track-by="value"
                        placeholder="Buscar Participante"
                        :showNoOptions="false"
                        label="label">
                    </VueMultiselect>

                    <button @click="insert_participante()" class="mt-3 btn btn-sm btn-block btn-success">
                        Agregar
                    </button>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>

    
</template>

<script type="text/javascript">

import axios from 'axios';
import VueMultiselect from 'vue-multiselect'


export default {
    data() {
        return {

            servicios           : [],
            modal_title         : '',
            modal_activo        : '',
            tmp_user            : [],
            select_users        : [],
            options_users       : [],
            tmp_service         : [],
            cant_participantes  : 0
            
        }
    },
    components: {
        VueMultiselect 
    },
    methods: 
    {
        changeStatus(id_user_service = 0, tp_status,old_status = 0,id_service)
        {
            let me = this
            let ruta = '/servicios/edit/participante'

            axios.post(ruta,
                    {
                        'id_user'       : id_user_service,
                        'tp_status'     : tp_status,
                        'old_status'    : old_status,
                        'id_service'    : id_service
                    })
                .then(function (response) 
                {
                    let resp = response.data;
                    me.showToast(resp.color,resp.msg)
                    me.getServicio(id_service)

                    if(tp_status == 0)
                        me.getServicios()
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        insert_participante()
        {
            let me = this;

            if(me.select_users.length == 0)
                return;

            axios.post('/servicios/insert/participante',
                    {
                        'id_user'       :me.select_users.value,
                        'id_service'    :me.tmp_service.id,
                    })
                .then(function (response) 
                {
                    let resp = response.data;
                    me.showToast(resp.color,resp.msg)
                    me.getServicio(me.tmp_service.id)
                    me.getServicios()
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        asyncUsers(nr_unidad)
        {
            let me              = this;
            let lista_users     = me.filterUserActivos(me.tmp_user).map(item => item.id_user);

            axios.post('/servicios/get/users',
            {'lista_users':lista_users,'nr_unidad':nr_unidad})
                .then(function (response)  
                {
                    console.log(response.data)
                    let tmp_data = response.data;
                    me.options_users = tmp_data.participantes
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        showModal(id,data=[],modal_activo) 
        {
            $(id).modal('show');

            let me              = this
            me.modal_activo     = modal_activo;
            me.getServicio(data.id)
            


            if(modal_activo == 'modal_responsables')
                me.modal_title = 'Participantes'
        },
        filterUserActivos(data)
        {
            return data.filter(item => item.tp_activo == 1)
        },
        getServicio(id_servicio)
        {
            let me = this;
            axios.post('/servicios/get', {'id_servicio': id_servicio}).then(function (response) {
                
                me.tmp_service          = response.data.servicios
                me.tmp_user             = me.filterUserActivos(me.tmp_service.usuarios)
                me.cant_participantes   = me.tmp_user.length
                me.options_users        = []
                me.select_users         = []

                me.asyncUsers(me.tmp_service.nr_unidad)

            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getServicios()
        {
            let me = this;
            axios.post('/servicios/get')
                .then(function (response) {

                    let resp = response.data
                    me.servicios = resp.servicios;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    mounted() {
        this.getServicios();
    }
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>