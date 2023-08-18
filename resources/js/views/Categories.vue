<template>
    <div class="expenses-container">
        <div class="expenses-titles">
            <div class="expenses-titles left">Expense Categories</div>
            <div class="expenses-titles right">Expense Management > Expense Categories</div>
        </div>

        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="Category in Category" @click="selectRow(Category.id)" :key="Category.id" :class="{'highlight': (Category.id == selectedCategory)}" v-on:click="toggleModal">
                <td>{{ Category.category }}</td>
                <td>{{ Category.description }}</td>
                <td>{{ format_date(Category.created_at) }}</td>
                </tr>
            </tbody>
        </table>


            <button value="add" @click="toggleModal" class="closeButton" v-on:click="modalEdit = false">Add Category</button>

                <Modal @close="toggleModal" :modalActive="modalActive">
                    <div class="modal-content">
                    <h1>Add Category</h1>

                    <table>

                        <tr>
                            <td>Category:</td>
                            <td><input type="text" v-model="CategoryForm.category" placeholder="Enter Category" /></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input type="text" v-model="CategoryForm.description" placeholder="Enter Description" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="addCategory">Add Category</button>
                    </div>
                </Modal>


                <Modal @close="toggleModal" :modalActive="modalActive" v-if="this.modalEdit == true">
                    <div class="modal-content">
                    <h1>Update Category</h1>


                    <table>
                        <tr>
                            <td>Category:</td>
                            <td><input type="text" v-model="Category[index].category" placeholder="Enter Category" /></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><input type="text" v-model="Category[index].description" placeholder="Enter Description" /></td>
                        </tr>
                    </table>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="updateCategory">Update Category</button>
                        <button style="padding: 5px; width:20%;" type="button" v-on:click="deleteCategory">Delete Category</button>
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
            Category: {},
            Category2: {},
            selectedCategory: null,
            modalEdit: false,
            index: null,
            CategoryForm:{
                Category:null,
                description:null,
            }
        }
    },
    components:{
        Modal,
    },
    mounted(){
        axios.get('/getCategories')
        .then(response => {
            this.Category = response.data.categories;
        })
    },
    methods:{

          selectRow:function(Category){
                this.selectedCategory = Category;
                let CategoryIndex = Category - 1;
                this.index = CategoryIndex;
                this.modalEdit = true; 
            },

        addCategory:function(){
            const category = this.CategoryForm.category;
            const description = this.CategoryForm.description;
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/addCategory', {
            category: category,
            description: description,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        updateCategory:function(){

            const index = this.index + 1;
            const category = this.Category[this.index].category;
            const description = this.Category[this.index].description;

            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let time = date.getTime();
            let currentdate = month +"/"+ day +"/"+ year;


            axios.post('/editCategory', {
            index: index,
            category: category,
            description: description,
            date: currentdate,
            })
            .then(response => {
            console.log(response)
        })
        },

        deleteCategory:function(){

            const category = this.Category[this.index].category;
            const index = this.index;


            axios.post('/deleteCategory', {
            index: index,
            category: category,
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