<template>
    <div class="expenses-container">
        <div class="expenses-titles">
            <div class="expenses-titles left">Expenses</div>
            <div class="expenses-titles right">Expense Management Expenses</div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Expenses</th>
                    <th>amount</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Expenses in Expenses" @click="selectRow(Expenses.id)" :key="Expenses.id" :class="{'highlight': (Expenses.id == selectedExpenses)}" v-on:click="toggleModal">
                <td>{{ Expenses.expense }}</td>
                <td>{{ Expenses.amount }}</td>
                <td>{{ format_date(Expenses.created_at) }}</td>
                </tr>
            </tbody>
        </table>


            <button value="add" @click="toggleModal" class="closeButton" v-on:click="modalEdit = false">Add Expenses</button>

                <Modal @close="toggleModal" :modalActive="modalActive">
                    <div class="modal-content">
                    <h1>Add Expenses</h1>

                    <table>

                        <tr>
                            <td>expense:</td>
                            <td><input type="text" v-model="ExpensesForm.expense" placeholder="Enter Expenses" /></td>
                        </tr>
                        <tr>
                            <td>amount:</td>
                            <td><input type="text" v-model="ExpensesForm.amount" placeholder="Enter amount" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="addExpenses">Add Expenses</button>
                    </div>
                </Modal>


                <Modal @close="toggleModal" :modalActive="modalActive" v-if="this.modalEdit == true">
                    <div class="modal-content">
                    <h1>Update Expenses</h1>


                    <table>
                        <tr>
                            <td>expense:</td>
                            <td><input type="text" v-model="Expenses[index].expense" placeholder="Enter expense" /></td>
                        </tr>
                        <tr>
                            <td>amount:</td>
                            <td><input type="text" v-model="Expenses[index].amount" placeholder="Enter amount" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="updateExpenses">Update Expenses</button>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="deleteExpenses">Delete Expenses</button>
                    </div>
                </Modal>
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
            Expenses: {},
            Expenses2: {},
            selectedExpenses: null,
            modalEdit: false,
            index: null,
            ExpensesForm:{
                expense:null,
                amount:null,
            }
        }
    },
    components:{
        Modal,
    },
    mounted(){
        axios.get('/getExpenses')
        .then(response => {
            this.Expenses = response.data.Expenses;
        })
    },
    methods:{

          selectRow:function(Expenses){
                this.selectedExpenses = Expenses;
                let ExpensesIndex = Expenses - 1;
                this.index = ExpensesIndex;
                this.modalEdit = true; 
            },

        addExpenses:function(){
            const expense = this.ExpensesForm.expense;
            const amount = this.ExpensesForm.amount;
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/addExpense', {
            expense: expense,
            amount: amount,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        updateExpenses:function(){

            const index = this.index + 1;
            const expense = this.Expenses[this.index].expense;
            const amount = this.Expenses[this.index].amount;

            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/editExpense', {
            index: index,
            expense: expense,
            amount: amount,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        deleteExpenses:function(){

            const expense = this.Expenses[this.index].expense;
            const index = this.index;


            axios.post('/deleteExpense', {
            index: index,
            expense: expense,
            })
            .then(response => {
            console.log(response)
        })
        },


        format_date(value){
         if (value) {
           return moment(String(value)).format('YYYY/MM/DD')
          }
      },
    },
    setup(){
        const modalActive = ref(false);

        const toggleModal = () => {
            modalActive.value = !modalActive.value;
        }

        return { modalActive, toggleModal };
    }
}
</script>             