<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Join as a Wordskills Travel Member</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" @submit.prevent="register">
                                <div class="form-group">
                                    <label class="control-label">Email Address:</label>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        placeholder="Enter your email address"
                                        v-model="data.email"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Enter your password"
                                        v-model="data.password"
                                    >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Name:</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Enter your name"
                                        v-model="data.name"    
                                    >
                                </div>  
                                <div class="form-group">
                                    <label class="control-label">Phone Number:</label>
                                    <input 
                                        type="tel" 
                                        class="form-control" 
                                        placeholder="Enter your phone number"
                                        v-model="data.phone"    
                                    >
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from '../Navbar/Navbar.vue'
import axios from 'axios';

export default {
    data() {
        return {
            data: {
                email: '',
                password: '',
                name: '',
                phone: ''
            },
            token: ''
        }
    },
    components: {
        'app-navbar': Navbar
    },

    methods: {
        register() {
            axios.post('/api/register', this.data)
                .then(response => {
                    this.token = response.data.token;
                    localStorage.setItem('token', this.token)
                    this.$router.push({path: '/'})
                })
        }
    }
}
</script>