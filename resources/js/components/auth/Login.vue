<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h2>Log in to your account</h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" action="#">
                                <div class="form-group">
                                    <label class="control-label">Email Address:</label>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        placeholder="Enter your email address"
                                        v-model="data.email">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password:</label>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        placeholder="Enter your password"
                                        v-model="data.password">
                                </div>
                                <div class="text-right">
                                    <button 
                                        type="submit" 
                                        class="btn btn-primary"
                                        @click.prevent='btnLogin'
                                        >Log In</button>
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
                password: ''
            }
        }
    },
    created() {
        if(this.$store.getters.isAuth){
            this.$router.push('/');
        }
    },
    components: {
        'app-navbar': Navbar
    },
    methods: {
        btnLogin() {
            axios.post('/api/login', this.data)
                .then(response => {
                    if(response.data.status == "Success") {
                        localStorage.setItem('token', response.data.token);
                        this.$router.push('/');
                    } else {
                        
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        }
    }
}
</script>