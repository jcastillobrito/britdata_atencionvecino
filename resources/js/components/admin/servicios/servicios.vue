<template lang="">

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
                <th>Visto Bueno Jefatura</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in servicios">
                <td>{{item.nombre}}  <span class="badge  rounded-pill" :class="{'bg-danger': item.usuarios.length === 0, 'bg-primary': item.usuarios.length > 0}" title="Cantidad Integrantes">{{item.usuarios.length }}</span></td>
                <td>{{item.descripcion_servicio}} </td>
                <td>{{item.unidad.nombre}}</td>
                <td>{{item.depto.nombre}}</td>
                <td> -</td>
                <td> - </td>               
                <td>{{ item.tp_activo ? 'Habilitado' : 'Desactivado' }}</td>
                <td>
                    <button @click="showModal('#modal_generico',item,'modal_responsables')" title="Responsables" class="btn btn-xs btn-primary">
                        <em class="icon ni ni-users"></em>
                    </button>

                    <button title="Editar" class="btn btn-xs btn-warning mx-1">
                        <em class="icon ni ni-edit-alt"></em>
                    </button>

                    <button title="Desactivar" class="btn btn-xs btn-danger mx-1">
                        <em class="icon ni ni-trash-alt"></em>
                    </button>
                </td>
            </tr>
        </tbody>
    </table> 


  
    <div class="modal" tabindex="-1" id="modal_generico">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{modal_title}}</h5>
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
                                    <span v-if="user.users.unidad">{{ user.users.unidad.nombre}}</span> <br>
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
                        @search-change="asyncUsers"
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
            servicios       : [],
            modal_title     : '',
            modal_activo    : '',
            tmp_user        : [],
            select_users    : [],
  	        options_users   : [],
            tmp_service_id  : 0,
            
        }
    },
    components: {
        VueMultiselect 
    },
    methods: {
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
                        'id_service'    :me.tmp_service_id,
                    })
                .then(function (response) 
                {
                    let resp = response.data;
                    me.showToast(resp.color,resp.msg)
                    me.getServicio(me.tmp_service_id)
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        asyncUsers(texto)
        {
            let me = this;

            if(texto.length <= 3)
                return;

            let lista_users = me.tmp_user.map(function(item) {
                return item.id_user;
            });

            axios.post('/servicios/get/users',
            {'lista_users':lista_users,'texto':texto})
                .then(function (response) 
                {
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
            me.tmp_service_id   = data.id

            if(modal_activo == 'modal_responsables')
                me.modal_title = 'Participantes'
        },
        getServicio(id_servicio)
        {
            let me = this;
            axios.post('/servicios/get', {'id_servicio': id_servicio}).then(function (response) {
                    
                    let resp    = response.data.servicios
                    if(resp.length > 0)
                        {
                            me.tmp_user         = resp[0].usuarios;
                            me.options_users    = []
                            me.select_users     = []
                        }

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