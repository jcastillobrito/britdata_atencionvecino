<template>

    <div class="modal fade" tabindex="-1" id="modalUser">
        <div class="modal-dialog modal-dialog-top modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Modal Title</h5>
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
                                                                <div class="badge bg-light rounded-pill ucap">{{ user.roles[0].name }}</div>
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
                                                                <span class="sub-text">Billing Email:</span>
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
                                                        <div class="overline-title-alt mb-2 mt-2">Tickets Cerrados</div>
                                                        <div class="profile-balance">
                                                            <div class="profile-balance-group gx-4">
                                                                <div class="profile-balance-sub">
                                                                    <div class="profile-balance-amount">
                                                                        <div class="number">237.89 <small class="currency currency-usd">USD</small></div>
                                                                    </div>
                                                                    <div class="profile-balance-subtitle">Wallet Balance</div>
                                                                </div>
                                                                <div class="profile-balance-sub">
                                                                    <span class="profile-balance-plus text-soft"><em class="icon ni ni-plus"></em></span>
                                                                    <div class="profile-balance-amount">
                                                                        <div class="number">1,643</div>
                                                                    </div>
                                                                    <div class="profile-balance-subtitle">Credit Points</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-block">
                                                        <h6 class="lead-text mb-3">Tickets Activos</h6>
                                                        <div class="nk-tb-list nk-tb-ulist is-compact border round-sm">
                                                            <div class="nk-tb-item nk-tb-head">
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">Order ID</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="sub-text">Product Name</span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-xxl">
                                                                    <span class="sub-text">Total Price</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">Status</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">Delivery</span>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col">
                                                                    <a href="#"><span class="fw-bold">#4947</span></a>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="tb-product">
                                                                        <img src="images/product/c.png" alt="" class="thumb">
                                                                        <span class="title">Black Mi Band Smartwatch</span>
                                                                    </span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-xxl">
                                                                    <span class="amount">$ 89.49</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text text-warning">Shipped</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">In 2 days</span>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col">
                                                                    <a href="#"><span class="fw-bold">#4948</span></a>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="tb-product">
                                                                        <img src="images/product/b.png" alt="" class="thumb">
                                                                        <span class="title">Purple Smartwatch</span>
                                                                    </span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-xxl">
                                                                    <span class="amount">$299.49</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text text-success">Delivered</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">12 Dec, 2020</span>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-item">
                                                                <div class="nk-tb-col">
                                                                    <a href="#"><span class="fw-bold">#4949</span></a>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-sm">
                                                                    <span class="tb-product">
                                                                        <img src="images/product/a.png" alt="" class="thumb">
                                                                        <span class="title">Pink Fitness Tracker</span>
                                                                    </span>
                                                                </div>
                                                                <div class="nk-tb-col tb-col-xxl">
                                                                    <span class="amount">$99.49</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="lead-text text-danger">Canceled</span>
                                                                </div>
                                                                <div class="nk-tb-col">
                                                                    <span class="sub-text">Never</span>
                                                                </div>
                                                            </div>
                                                        </div><!-- .nk-tb-list -->
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
export default {
    data() {
        return {
        }
    },
    props: ['user'],
    methods: {
        
    },
    mounted() {
        console.log(this.user);
    }
}
</script>