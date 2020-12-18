@extends('layouts.app')

@section('content')
    <dashboard-ui inline-template>
        <div class="dashboard">
            <div class="menu" :class="{'menu--compact' : compact}">
                <div class="menu__header" >
                    <div class="user">


                        <div class="user__name">
                            {{Auth::user()->name}} 
                        </div>

                        <div class="user__role">
                            
                            {{Auth::user()->role->name}}
                        </div>
                        

                        <font-awesome-icon @click="compact = !compact" size="lg" class="bars" icon="bars"></font-awesome-icon>
                    </div>
    
                </div>
    
                <div class="menu__links">
                    <a href="#">Dashboard</a>
                    <a href="#">Clients</a>
                    <a href="#">Manage users</a>
                    <a href="#">Settings</a>
                </div>
            </div>
    
            <div class="content" :class="{'content--expend' : !compact}">
                Lorem ipsum dolor sit amet 
            </div>
        </div>
    </dashboard-ui>
@endsection
