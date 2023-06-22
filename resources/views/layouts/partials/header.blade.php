<div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                    <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                </a>
                            </div><!-- .nk-header-brand -->
                            <div class="nk-header-news d-none d-xl-block">
                                <div class="nk-news-list">
                                    <a class="nk-news-item" href="#">
                                        <div class="nk-news-icon">
                                            <em class="icon ni ni-card-view"></em>
                                        </div>
                                        <div class="">
                                            <p>{{$mensaje}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- .nk-header-news -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li  class="dropdown notification-dropdown  mx-2">
                                        <a href="#" class="dropdown-toggle " data-bs-toggle="dropdown">
                                            <button class="btn  btn-outline-light text-white  {{ auth()->user()->unreadNotifications->count()?'btn-warning':'btn-success' }}">
                                                <em class="icon ni ni-bell"></em>
                                            </button>
                                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ auth()->user()->unreadNotifications->count() }}  
                                            <span class="visually-hidden">unread messages</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification">

                                                @foreach($notifications as $notification)
                                                    
                                                    
                                                            
                                                        @if(!$notification->read_at)
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <form method="POST" action="{{ route('notifications.read',$notification->id) }}" >
                                                                    {{method_field('PATCH')}}
                                                                    {{csrf_field() }}
                                                                    <button class="icon icon-circle bg-warning-dim ni  ni-eye-off-fill sin-borde"></button>
                                                                </form>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">{{ $notification->data['body']}}</div>
                                                                <div class="nk-notification-time">{{ date('d-m-Y', strtotime($notification->data['created_at'])) }}</div>
                                                            </div>
                                                        </div> 
                                                        @else
                                                            

                                                            <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <form method="POST" action="{{ route('notifications.read',$notification->id) }}" >
                                                                    {{method_field('PATCH')}}
                                                                    {{csrf_field() }}
                                                                    <button class="icon icon-circle bg-success-dim ni  ni-eye-fill sin-borde"></button>
                                                                </form>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text"> {{ $notification->data['body']}}  <strong><i>...Leido</i></strong>  </div>
                                                                <div class="nk-notification-time">{{ date('d-m-Y', strtotime($notification->data['created_at'])) }}</div>
                                                            </div>
                                                        </div> 
                                                        @endif

                                                            
                                                        



                                                @endforeach
                                                
                                                    
                                                </div><!-- .nk-notification -->
                                            </div><!-- .nk-dropdown-body -->
                                            <div class="dropdown-foot center">
                                                <a href="#">View All</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">{{$nm_institucion}}</div>
                                                    <div class="user-name dropdown-indicator">{{$nombre.' - '.$role}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">Abu Bin Ishtiyak</span>
                                                        <span class="sub-text">info@softnio.com</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            <em class="icon ni ni-signout"></em>
                                                            <span>Sign out</span>
                                                        </a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                   <!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>