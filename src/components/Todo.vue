<template>
    <form @submit.prevent="onSubmit">
        <span class="help is-danger" v-text="errors"></span>

        
        <div class="field">
            <div class="control">
                <input class="input" type="name"  style="width:170px;" placeholder="enter todo .." v-model="name" @keydown="errors = ''" >
            </div>
        </div>

        <button class="button is-primary" v-bind:class="{ 'is-loading' : isLoading }">Add Todo</button>
    </form>
</template>

<script>
import axios from 'axios'
import { API_BASE_URL } from '../config'

export default {
    data() {
        return {
            id : '', 
            name: '',
            errors: '',
            isCompleted: false,
            isLoading: false
        }
    },
    async ifExists () {      
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
        onSubmit() {
            this.isLoading = true
            this.postTodo()
        },
        async postTodo() {
            axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
            console.log(this.$data)
            axios.post(API_BASE_URL + '/todo', this.$data)
                .then(response => {
                    this.name = ''
                    this.isLoading = false
                    this.$emit('completed', response.data)
                })
                .catch(error => {
                    // handle authentication and validation errors here
                    this.errors = error.response.data.errors
                    this.isLoading = false
                })
        }
    }
}
</script>