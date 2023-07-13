<template lang="">

    <table class="table table-sm table-bordered table-responsive">
        <thead class="bg-primary  text-white text-center"  style="border: 1px solid white">
            <tr>
                <th colspan=6>Servicios</th>
            </tr>
            <tr>
                <th>Servicio</th>
                <th>Unidad</th>
                <th>Depto</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in servicios">
                <td>{{item.nombre}}  <span class="badge bg-primary rounded-pill">{{item.users.length }}</span></td>
                <td>{{item.unidad.nombre}}</td>
                <td>{{item.depto.nombre}}</td>
                <td>{{ item.tp_activo ? 'Habilitado' : 'Desactivado' }}</td>
                <td>
                    <button @click="showModal('#modal_generico',item.users,'modal_responsables')" title="Responsables" class="btn btn-xs btn-primary">
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
                        <li v-for="user in tmp_data" class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold">{{user.nombres+' '+user.ap_paterno+' '+user.ap_materno}}</div>
                            {{ user.email}}
                            </div>
                            <button class="badge bg-danger rounded-pill">
                                X
                            </button>
                        </li>                        
                    </ol>

                    <VueMultiselect 
                        class="mt-3"
                        v-model="value" 
                        :options="options"
                        >
                    </VueMultiselect>

                    <button class="mt-3 btn btn-sm btn-block btn-success">
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
            tmp_data        : [],
            value: 'opcion #1',
  	        options: ['opcion #1','opcion #2']
        }
    },
    components: {
        VueMultiselect 
    },
    methods: {
        showModal(id,data=[],modal_activo) 
        {
            $(id).modal('show');

            let me          = this
            me.modal_activo = modal_activo;
            me.tmp_data     = data;

            if(modal_activo == 'modal_responsables')
                me.modal_title = 'Responsables'
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