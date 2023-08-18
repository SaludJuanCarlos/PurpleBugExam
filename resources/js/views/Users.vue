<template>
    <div class="roles-container">
        <div class="roles-titles">
            <div class="roles-titles left">Users</div>
            <div class="roles-titles right">User Management > Users</div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Roles</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" @click="selectRow(user.id)" :key="user.id" :class="{'highlight': (user.id == selectedUser)}" v-on:click="toggleModal">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.role }}</td>
                <td>{{ format_date(user.created_at) }}</td>
                </tr>
            </tbody>
        </table>


            <button value="add" @click="toggleModal" class="closeButton" v-on:click="modalEdit = false">Add User</button>

                <Modal @close="toggleModal" :modalActive="modalActive">
                    <div class="modal-content">
                    <h1>Add User</h1>

                    <table>

                        <tr>
                            <td>Name:</td>
                            <td><input type="text" v-model="userForm.name" placeholder="Enter Name" /></td>
                        </tr>
                        <tr>
                            <td>Email Address:</td>
                            <td><input type="text" v-model="userForm.email" placeholder="Enter Email Address" /></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <select id="role" name="role" v-model="userForm.role">
                              <option value="user" selected="true">User</option>
                              <option value="admin">Admin</option>
                            </select>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="addUser">Add User</button>
                    </div>
                </Modal>


                <Modal @close="toggleModal" :modalActive="modalActive" v-if="this.modalEdit == true">
                    <div class="modal-content">
                    <h1>Update User</h1>


                    <table>
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" v-model="users[index].name" placeholder="Enter Name" /></td>
                        </tr>
                        <tr>
                            <td>Email Address:</td>
                            <td><input type="text" v-model="users[index].email" placeholder="Enter Email Address" /></td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <select id="role" name="role" v-model="users[index].role">
                              <option value="user" selected="true">User</option>
                              <option value="admin">Admin</option>
                            </select>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="updateUser">Update User</button>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="deleteUser">Delete User</button>
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
            users: {},
            users2: {},
            selectedUser: null,
            modalEdit: false,
            index: null,
            userForm:{
                name:null,
                email:null,
                role:null,
            }
        }
    },
    components:{
        Modal,
    },
    mounted(){
        axios.get('/getUsers')
        .then(response => {
            this.users = response.data.users;
        })
    },
    methods:{

          selectRow:function(user){
                this.selectedUser = user;
                let userIndex = user - 1;
                this.index = userIndex;
                this.modalEdit = true; 
            },

        addUser:function(){
            const name = this.userForm.name;
            const email = this.userForm.email;
            const role = this.userForm.role;
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/addUser', {
            name: name,
            email: email,
            role: role,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        updateUser:function(){

            const index = this.index + 1;
            const name = this.users[this.index].name;
            const email = this.users[this.index].email;
            const role = this.users[this.index].role;

            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/editUser', {
            index: index,
            name: name,
            email: email,
            role: role,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        deleteUser:function(){

            const index = this.index + 1;
            const email = this.users[this.index].email;


            axios.post('/deleteUser', {
            index: index,
            email: email,
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