<template>
    <div>
        <div v-if="isLoading">Loading players...</div>
        <div v-else>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                    <!-- <th>Edit</th> -->
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="todo in todo" >
                    
                    <tr v-bind:key="todo.id"> 
                        
                        <td>{{ todo.name }}</td>
                        <!-- <td><a class="button is-primary">Complete</a></td> -->
                        <td>
                            <button class="button is-primary" v-bind:class="{ 'is-loading' : hasDone(todo.id) }" @click="doneTodo(todo.id)">Done</button>
                        </td>
                        <td><button class="button is-primary" v-bind:class="{ 'is-loading' : isDeleting(todo.id) }" @click="deleteTodo(todo.id)">Delete</button></td>
                    </tr>
                </template>
            </tbody>
        </table>
        <!-- <a class="button is-primary">Add Todo</a> -->
        <todo @completed="addTodo"></todo>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import { API_BASE_URL } from '../config'
import Todo from './Todo.vue'


export default {
    components: {
        Todo
    },

    
    data() {
        return {
            isLoading: true,
            todo: {}
        }
    },
    async created () {      
       axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
        try {
            const response = await axios.get(API_BASE_URL + '/todo')
            this.todo = response.data            
            this.isLoading = false
        } catch (e) {
            // handle the authentication error here
        }
    },
    methods: {
        addTodo(todo) {
            this.todo.push(todo)
        },

        isDeleting(id) {
            let index = this.todo.findIndex(todo => todo.id === id)
            return this.todo[index].isDeleting
        },
        async deleteTodo(id) {
            let index = this.todo.findIndex(todo => todo.id === id)
            Vue.set(this.todo[index], 'isDeleting', true)
            await axios.delete(API_BASE_URL + '/todo/' + id)
            this.todo.splice(index, 1)
        },

        hasDone(id) {
            let index = this.todo.findIndex(todo => todo.id === id)
            return this.todo[index].hasDone
        },
        
        doneTodo(id) {
            let index = this.todo.findIndex(todo => todo.id === id)
            this.todo[index]['isCompleted'] = 1 - this.todo[index]['isCompleted']
        },

        checkStrikethrough(element) {
                console.log(element)
               

        }

    }
}
</script>