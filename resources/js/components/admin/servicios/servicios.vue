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
        <div class="modal-dialog modal-md">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{modal_title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div v-if="modal_activo == 'modal_responsables'">

                    <ol class="list-group list-group-numbered">
                        <li v-for="user in tmp_user" class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold">{{user.users.nombres+' '+user.users.ap_paterno+' '+user.users.ap_materno}}</div>
                            {{ user.email}}
                            </div>
                            <button v-if="user.tp_respuesta_final" class="btn btn-xs btn-primary mx-1" title="Permiso Respuesta Final">
                                <em class="icon ni ni-edit-fill"></em>
                            </button>
                            <button class="btn btn-xs btn-danger mx-1" title="Quitar">
                                <em class="icon ni ni-file-remove-fill"></em>
                            </button>
                            
                        </li>                        
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
            tmp_service_id  : 0
        }
    },
    components: {
        VueMultiselect 
    },
    methods: {
        insert_participante()
        {
            let me = this;

            if(me.select_users.length == 0)
                return;

            axios.post('/servicios/insert/participante',
            {'id_user':me.select_users.value,'id_service':me.tmp_service_id})
                .then(function (response) 
                {
                    let resp = response.data;
                    me.showToast(resp.color,resp.msg)
                    me.getServicios
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
                return item.id;
            });

            axios.post('/servicios/get/users',
            {'lista_users':lista_users,'texto':texto})
                .then(function (response) {
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
            me.tmp_user         = data.usuarios;
            me.tmp_service_id   = data.id

            if(modal_activo == 'modal_responsables')
                me.modal_title = 'Participantes'
        },
        getServicios()
        {
            let me = this;
            axios.get('/servicios/get')
                .then(function (response) {
                    me.servicios = response.data.servicios;
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