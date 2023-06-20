<template>
    <div class="row">

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Nombres</label>
                <div class="form-control-wrap">
                    <input v-model="nombres" type="text" class="form-control" id="default-01" placeholder="Nombres">
                    <small class="text-danger" v-if="errors.nombres">{{ errors.nombres[0] }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Apellido Paterno</label>
                <div class="form-control-wrap">
                    <input v-model="ap_paterno" type="text" class="form-control" id="default-01" placeholder="Apellido Materno">
                    <small class="text-danger" v-if="errors.ap_paterno">{{ errors.ap_paterno[0] }}</small>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Apellido Materno</label>
                <div class="form-control-wrap">
                    <input v-model="ap_materno" type="text" class="form-control" id="default-01" placeholder="Apellido Paterno">
                    <small class="text-danger" v-if="errors.ap_materno">{{ errors.ap_materno[0] }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Rut</label>
                <div class="form-control-wrap">
                    <input v-model="nr_rut" type="text" class="form-control" id="default-01" placeholder="Ingrese Rut">
                    <small class="text-danger" v-if="errors.nr_rut">{{ errors.nr_rut[0] }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Email</label>
                <div class="form-control-wrap">
                    <input v-model="email" type="text" class="form-control" id="default-01" placeholder="Ingrese Email">
                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Teléfono</label>
                <div class="form-control-wrap">
                    <input  v-model="celular" type="number" maxlength="9" class="form-control" placeholder="Ingrese Celular">
                    <small class="text-danger" v-if="errors.celular">{{ errors.celular[0] }}</small>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12" v-if="tmp_user.unidad">
            <div class="form-group">
                <label class="form-label" for="default-01">Unidad</label>
                <div class="form-control-wrap">
                   <select v-model="nr_unidad" @change="filterDeptos()" name="" id="" class="form-control">
                        <option :key="index" :value="unidad.id"  v-for="(unidad,index) in unidades"> {{ unidad.nombre }}</option>
                   </select>
                   <small class="text-danger" v-if="errors.nr_unidad">{{ errors.nr_unidad[0] }}</small>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Depto</label>
                <select v-model="nr_depto"  class="form-control">
                    <option value="0">Seleccionar Departamento</option>
                    <option :key="index" :value="depto.id" v-for="(depto,index) in deptos" >{{ depto.nombre }}</option>
                </select>
                <small class="text-danger" v-if="errors.nr_depto">{{ errors.nr_depto[0] }}</small>

                <div class="form-control-wrap">
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Rol</label>
                <div class="form-control-wrap">
                    <select  v-model="nr_rol" class="form-control" >
                        <option :key="index" :value="rol.id" v-for="(rol,index) in roles" >{{ rol.name }}</option>
                    </select>
                    <small class="text-danger" v-if="errors.nr_rol">{{ errors.nr_rol[0] }}</small>

                </div>
            </div>
        </div>

        <div class="col-md-4 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Estado</label>
                <div class="form-control-wrap">
                    <select v-model="tp_activo" name="" id="" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0" >Inactivo</option>
                    </select>
                    <small class="text-danger" v-if="errors.tp_activo">{{ errors.tp_activo[0] }}</small>

                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">ID Externo</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control" v-model="id_externo" placeholder="Ingrese el ID Externo">
                    <small class="text-danger" v-if="errors.id_externo">{{ errors.id_externo[0] }}</small>

                </div>
            </div>
        </div>


        <div class=" offset-md-3  col-md-6 col-xs-12 mt-3">
            <button @click="updateUser()" class="btn btn-sm btn-primary btn-block">
                <span>Actualizar usuario</span>
            </button>
        </div>
        

    </div>
</template>
<script>
import axios from 'axios';
export default {

    props: ['user','init'],
    data() {
        return {
            tmp_user : { ...this.user },
            setUp       :   {},
            unidades    :   {},
            deptos      :   {},
            roles       :   {},
            nr_unidad   :   1,
            nr_depto    :   1,
            nr_rol      :   1,
            id_externo  :   1,
            tp_activo   :   1,
            celular     :   1,
            nombres     :   '',
            ap_paterno  :   '',
            ap_materno  :   '',
            nr_rut      :   '',
            email       :   '',
            errors      :   [],

        }
    },
    watch: {
        user(newVal) {
            this.tmp_user   = { ...newVal }; // Actualizar tmp_user cuando user cambie

            this.nr_unidad  = this.tmp_user.unidad.id;
            this.nr_rol     = this.tmp_user.roles[0].id;
            this.tp_activo  = this.tmp_user.tp_activo;
            this.id_externo = this.tmp_user.id_externo;
            this.celular    = this.tmp_user.celular;
            this.nombres    = this.tmp_user.nombres;
            this.ap_paterno = this.tmp_user.ap_paterno;
            this.ap_materno = this.tmp_user.ap_materno;
            this.nr_rut     = this.tmp_user.nr_rut;
            this.email      = this.tmp_user.email;

            this.filterDeptos()



            if(this.tmp_user.depto)
                this.nr_depto = this.tmp_user.depto.id;
            else
                this.nr_depto = 0


        },
        init(newVal) {
            this.setUp = { ...newVal }; // Actualizar tmp_user cuando user cambie
            this.unidades = this.setUp.unidades
            this.deptos = this.setUp.deptos
            this.roles = this.setUp.roles;

        }
    },
    methods: {
        updateUser()
        {
            let me = this;
            let user_tmp = {
                nr_unidad   : me.nr_unidad,
                nr_depto    : me.nr_depto,
                nr_rol      : me.nr_rol,
                tp_activo   : me.tp_activo,
                id_externo  : me.id_externo,
                celular     : me.celular,
                nombres     : me.nombres,
                ap_paterno  : me.ap_paterno,
                ap_materno  : me.ap_materno,
                nr_rut      : me.nr_rut,
                email       : me.email,
                id          : me.tmp_user.id     
            }
            
            axios.put('/user',user_tmp)
            .then(function (response) 
            {
                let resp = response.data
                me.showToast(resp.color,resp.msg)

                me.$emit('eventoPersonalizado', 'Juan Carlos');
                //me.$emit('updateUser',response.data)
            }).catch(function (error) {
                 if(error.response.status == 422)
                    {
                        me.showToast('error','Favor revisar Formulario')
                        me.errors = error.response.data.errors;
                    }
            });
        },
        filterDeptos()
        {
            let me = this
            if(me.setUp.deptos)
                me.deptos = me.setUp.deptos.filter(el => el.nr_unidad == me.nr_unidad);
            
        }
     
    },
    mounted() {
    }
    
}
</script>