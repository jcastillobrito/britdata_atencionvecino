<template>
    <div class="row">

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Nombre</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.nombres" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Apellido Paterno</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.ap_paterno" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Apellido Materno</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.ap_materno" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Rut</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.nr_rut" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Email</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.email" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Teléfono</label>
                <div class="form-control-wrap">
                    <input v-model="tmp_user.celular" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Unidad</label>
                <div class="form-control-wrap">
                   <select v-model="nr_unidad" @change="filterDeptos()" name="" id="" class="form-control">
                        <option :key="index" :value="unidad.id"  v-for="(unidad,index) in setUp.unidades"> {{ unidad.nombre }}</option>
                   </select>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Depto</label>
                <select name="" id="" class="form-control">
                    <option :key="index" :value="depto.id" v-for="(depto,index) in deptos" >{{ depto.nombre }}</option>
                </select>
                <div class="form-control-wrap">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Rol</label>
                <div class="form-control-wrap">
                    <input v-if="tmp_user.roles" v-model="tmp_user.roles[0].name" type="text" class="form-control" id="default-01" placeholder="Input placeholder">
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12 ">
            <div class="form-group">
                <label class="form-label" for="default-01">Estado</label>
                <div class="form-control-wrap">
                    <select name="" id="" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0" >Inactivo</option>
                    </select>
                </div>
            </div>
        </div>

        <div class=" offset-md-3  col-md-6 col-xs-12 mt-3">
            <button class="btn btn-sm btn-primary btn-block">
                <span>Actualizar usuario</span>
            </button>
        </div>
      


        

    </div>
</template>
<script>
export default {

    props: ['user','init'],
    data() {
        return {
            tmp_user : { ...this.user },
            setUp : {},
            deptos :{},
            nr_unidad : 1
        }
    },
    watch: {
        user(newVal) {
            this.tmp_user = { ...newVal }; // Actualizar tmp_user cuando user cambie
        },
        init(newVal) {
            this.setUp = { ...newVal }; // Actualizar tmp_user cuando user cambie
        }
    },
    methods: {

        filterDeptos()
        {
            let me = this

            me.deptos = me.setUp.deptos.filter(el => el.nr_unidad == me.nr_unidad);

            console.log(me.deptos)
        }
     
    },
    mounted() {
    }
    
}
</script>