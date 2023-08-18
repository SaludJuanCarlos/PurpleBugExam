

<script>
import {RouterView} from "vue-router"
import Header from './shared/Header.vue'


export default {


    data: () => ({
    }),

    components:{
        Header,
    },

}
</script>

<template> 
        <Header />
        <div class="sidebar">
            <div class="person">
                <div class="picture"><img src="{{ asset('/images/avatar.png') }}" alt="Avatar" class="avatar"></div>
                <div class="name">Juan Dela Cruz</div>
            </div>

            <router-link to="/dashboard">Dashboard</router-link>   
            <div style="margin-bottom">
                <p style="margin-bottom:10px;">User Management</p>
                <router-link to="/roles">Roles</router-link>  
                <router-link to="/users">Users</router-link>   
            </div>

            <div>
                <p style="margin-bottom:10px;">Expense Management</p>
                <router-link to="/categories">Expense Categories</router-link>   
                <router-link to="/expenses">Expense</router-link>   
            </div>

        </div>

        <div class="content">
            <router-view/>
        </div>
</template>