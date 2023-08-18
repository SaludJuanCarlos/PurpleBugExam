<template>
    <div class="roles-container">
        <div class="roles-titles">
            <div class="roles-titles left">Roles</div>
            <div class="roles-titles right">Roles Management > Roles</div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Roles</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Roles in Roles" @click="selectRow(Roles.id)" :key="Roles.id" :class="{'highlight': (Roles.id == selectedRoles)}" v-on:click="toggleModal">
                <td>{{ Roles.role }}</td>
                <td>{{ Roles.description }}</td>
                <td>{{ format_date(Roles.created_at) }}</td>
                </tr>
            </tbody>
        </table>


            <button value="add" @click="toggleModal" class="closeButton" v-on:click="modalEdit = false">Add Roles</button>

                <Modal @close="toggleModal" :modalActive="modalActive">
                    <div class="modal-content">
                    <h1>Add Roles</h1>

                    <table>

                        <tr>
                            <td>Role:</td>
                            <td><input type="text" v-model="RolesForm.role" placeholder="Enter Role" /></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input type="text" v-model="RolesForm.description" placeholder="Enter Description" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="addRoles">Add Roles</button>
                    </div>
                </Modal>


                <Modal @close="toggleModal" :modalActive="modalActive" v-if="this.modalEdit == true">
                    <div class="modal-content">
                    <h1>Update Roles</h1>


                    <table>
                        <tr>
                            <td>Role:</td>
                            <td><input type="text" v-model="Roles[index].role" placeholder="Enter Role" /></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input type="text" v-model="Roles[index].description" placeholder="Enter Description" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="updateRoles">Update Roles</button>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="deleteRoles">Delete Roles</button>
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
            Roles: {},
            Roles2: {},
            selectedRoles: null,
            modalEdit: false,
            index: null,
            RolesForm:{
                role:null,
                description:null,
            }
        }
    },
    components:{
        Modal,
    },
    mounted(){
        axios.get('/getRoles')
        .then(response => {
            this.Roles = response.data.Roles;
        })
    },
    methods:{

          selectRow:function(Roles){
                this.selectedRoles = Roles;
                let RolesIndex = Roles - 1;
                this.index = RolesIndex;
                this.modalEdit = true; 
            },

        addRoles:function(){
            const role = this.RolesForm.role;
            const description = this.RolesForm.description;
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/addRole', {
            role: role,
            description: description,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        updateRoles:function(){

            const index = this.index + 1;
            const role = this.Roles[this.index].role;
            const description = this.Roles[this.index].description;

            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/editRole', {
            index: index,
            role: role,
            description: description,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        deleteRoles:function(){

            const role = this.Roles[this.index].role;
            const index = this.index;


            axios.post('/deleteRole', {
            index: index,
            role: role,
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