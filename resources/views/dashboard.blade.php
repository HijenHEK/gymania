@extends('layouts.app')

@section('content')
    <vue-alert :msg="alertMsg" :active="alertActive" 
    :color="alertColor" :size="alertSize" :type="alertType"></vue-alert>

    <dashboard-ui inline-template>

        <div class="dashboard">
            <div class="menu" :class="{'menu--compact' : compact}">


                <div class="menu__header" >
                    <div class="user">


                        <span class="user__name">
                            {{Auth::user()->name}} 
                        </span>

                        <sub class="user__role">
                            
                            {{Auth::user()->role->name}}
                        </sub>
                        

                    </div>
                    
                    <font-awesome-icon @click="compact = !compact" size="2x" class="icon icon--toggle" :icon="compact ? 'bars' : 'times'"></font-awesome-icon>

                </div>
    
                <div class="menu__links">
                    
                    <router-link tag="a" class="link" to="/">
                        
                        <span>Dashboard</span> 

                        <font-awesome-icon size="lg" class="icon" icon="desktop"></font-awesome-icon>


                    </router-link>

                    <router-link tag="a" class="link" to="/members">
                        
                        <span>Members</span> 

                        <font-awesome-icon size="lg" class="icon" icon="users"></font-awesome-icon>


                    </router-link>
                    <router-link tag="a" class="link" to="/packages">
                        
                        <span>Packages</span> 

                        <font-awesome-icon size="lg" class="icon" icon="th-large"></font-awesome-icon>


                    </router-link>
                    <router-link tag="a" class="link" to="/activities">
                        
                        <span>Activities</span> 

                        <font-awesome-icon size="lg" class="icon" icon="dumbbell"></font-awesome-icon>


                    </router-link>
                    <router-link tag="a" class="link" to="/cycles">
                        
                        <span>Cycles</span> 

                        <font-awesome-icon size="lg" class="icon" icon="calendar-day"></font-awesome-icon>


                    </router-link>
                    
                    
                </div>


                <div class="menu__footer">
                    <div class="menu__links">
                        <router-link class="link" tag="a" to="/staff" >
                        
                            <span>Staff Management</span> 
    
                            <font-awesome-icon size="lg" class="icon" icon="user-cog"></font-awesome-icon>
    
    
                        </router-link>
                        <a class="link" href="#">
                            
                            <span>Settings</span> 
    
                            <font-awesome-icon size="lg" class="icon" icon="cogs"></font-awesome-icon>
    
    
                        </a>
                        <a class="link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span>{{ __('Logout') }}</span>
                                        <font-awesome-icon size="lg" class="icon icon--power" icon="power-off"></font-awesome-icon>

                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                    </div>
                    <div class="brand">
                        Gymania
                    </div>
                </div>
            </div>
    
            <div class="content" :class="{'content--expend' : !compact}">

                <router-view class="view"></router-view>
            </div>
        </div>
    </dashboard-ui>
@endsection
