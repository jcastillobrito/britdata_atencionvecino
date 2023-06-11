<template>

    <div class="modal fade" tabindex="-1" id="modalUser" >
        <div class="modal-dialog modal-dialog-top modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Detalle Usuario</h5>
                </div>
                <div class="modal-body">
                    <div class="row g-gs">
                        <div class="col-lg-4 col-xl-4 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner-group">
                                    <div class="card-inner">
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar lg bg-primary">
                                                <img src="images/avatar/b-sm.jpg" alt="">
                                            </div>
                                            <div class="user-info">
                                                <div v-if="user.roles" class="badge bg-light rounded-pill ucap">{{ user.roles[0].name }}</div>
                                                <h5>{{ user.nombres }}</h5>
                                                <span class="sub-text">{{ user.email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner card-inner-sm">
                                        <ul class="btn-toolbar justify-center gx-1">
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-shield-off"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                                            <li><a href="#" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-inner">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">23</span>
                                                    <span class="sub-text">Total Order</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">20</span>
                                                    <span class="sub-text">Complete</span>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="profile-stats">
                                                    <span class="amount">3</span>
                                                    <span class="sub-text">Progress</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <h6 class="overline-title mb-2">Short Details</h6>
                                        <div class="row g-3">
                                            <div class="col-sm-6 col-md-4 col-lg-12">
                                                <span class="sub-text">User ID:</span>
                                                <span>{{ user.id_externo }}</span>
                                            </div>
                                            <div class="col-sm-6 col-md-4 col-lg-12">
                                                <span class="sub-text"> Email:</span>
                                                <span>{{ user.email }}</span>
                                            </div>
                                            
                                        </div>
                                    </div><!-- .card-inner -->
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-lg-8 col-xl-8 col-xxl-9">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Datos Personales</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Tickets Activos</a>
                                            </li>
                                           
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem1">
                                                <user_update :init="init"  :user="user"></user_update>
                                            </div>
                                            <div class="tab-pane" id="tabItem2">
                                                <p>B</p>
                                            </div>
                                          
                                        </div>

                                    </div>
                                    <div class="nk-block">
                                        


                                    </div>
                                    
                                    
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div>
                
            </div>
        </div>
    </div>
    
</template>

<script>
import user_update from './user_update.vue';
export default {
    data() {
        return {
        }
    },
    components: {
        user_update
    },
    props: ['user','init'],
    methods: {
        
    },
    mounted() {
        console.log(this.user);
    }
}
</script>