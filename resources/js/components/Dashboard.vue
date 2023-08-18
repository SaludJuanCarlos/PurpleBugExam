<template>
    <div class="dashboard-container">
        <div class="dashboard-titles">
            <div class="dashboard-titles left">My Expenses</div>
            <div class="dashboard-titles right">Dashboard</div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Expense Categories</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Dashboard in Dashboard" :key="Dashboard.id" v-on:click="toggleModal">
                <td>{{ Dashboard.category }}</td>
                <td>{{ Dashboard.amount }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</template>

                            
<script> 
import moment from 'moment'
import DataTable from 'datatables.net-dt'
import 'datatables.net-responsive-dt';
import Modal from '@/components/Modal.vue'


let table = new DataTable('#myTable', {
    responsive: true
});

import axios from 'axios'
import {ref} from 'vue'

export default {
    data(){
        return{
            Dashboard: {},
            }
        },
    components:{
    },
    mounted(){
        axios.get('/getDashboard')
        .then(response => {
            this.Dashboard = response.data.dashboard;
        })
    },
}
</script>             