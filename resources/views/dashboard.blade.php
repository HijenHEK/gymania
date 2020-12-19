@extends('layouts.app')

@section('content')
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
                    <router-link tag="a" class="link" to="/clients">
                        
                        <span>clients</span> 

                        <font-awesome-icon size="lg" class="icon" icon="users"></font-awesome-icon>


                    </router-link>
                    <a class="link" href="#">
                        
                        <span>user management</span> 

                        <font-awesome-icon size="lg" class="icon" icon="user-cog"></font-awesome-icon>


                    </a>
                    <a class="link" href="#">
                        
                        <span>Settings</span> 

                        <font-awesome-icon size="lg" class="icon" icon="cogs"></font-awesome-icon>


                    </a>
                    
                </div>


                <div class="menu__footer">
                    <div class="menu__links">
                        
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
                <router-view></router-view>
            </div>
        </div>
    </dashboard-ui>
@endsection
