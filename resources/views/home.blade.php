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
                    <font-awesome-icon @click="compact = !compact" size="2x" class="icon" icon="bars"></font-awesome-icon>

                </div>
    
                <div class="menu__links">
                    <a href="#">
                        
                        <span>Dashboard</span> 

                        <font-awesome-icon size="lg" class="icon" icon="desktop"></font-awesome-icon>


                    </a>
                    <a href="#">
                        
                        <span>clients</span> 

                        <font-awesome-icon size="lg" class="icon" icon="users"></font-awesome-icon>


                    </a>
                    <a href="#">
                        
                        <span>user management</span> 

                        <font-awesome-icon size="lg" class="icon" icon="user-cog"></font-awesome-icon>


                    </a>
                    <a href="#">
                        
                        <span>Settings</span> 

                        <font-awesome-icon size="lg" class="icon" icon="cogs"></font-awesome-icon>


                    </a>
                    
                </div>
            </div>
    
            <div class="content" :class="{'content--expend' : !compact}">
                Lorem ipsum dolor sit amet 
            </div>
        </div>
    </dashboard-ui>
@endsection
