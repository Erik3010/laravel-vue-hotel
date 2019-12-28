<template>
    <div>
        <app-navbar></app-navbar>
            <div class="container">
                <section>
                    <h3>Hotel Booking</h3>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form @submit.prevent='searchHotel'>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div>
                                            <h4 class="form-heading">1. Destination / Hotel Name</h4>
                                            <div class="form-group">
                                                <input 
                                                    type="search" 
                                                    placeholder="City" 
                                                    class="form-control"
                                                    required
                                                    v-model="data.city">
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="form-heading">2. Duration of Stay</h4>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Check In:</label>
                                                        <input 
                                                            type="date" 
                                                            placeholder="Choose Check In Date" 
                                                            class="form-control"
                                                            required
                                                            v-model="data.checkIn">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Check Out:</label>
                                                        <input 
                                                            type="date" 
                                                            placeholder="Choose Check Out Date" 
                                                            class="form-control"
                                                            required
                                                            v-model="data.checkOut">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h4 class="form-heading">3. Search Hotels</h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Total Person:</label>
                                                    <select 
                                                        class="form-control"
                                                        required
                                                        v-model="data.person">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Total Room:</label>
                                                    <select 
                                                        class="form-control"
                                                        required
                                                        v-model="data.room">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Search Hotels</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
    </div>
</template>

<script>
// import router from 'vue-router'
import Navbar from './Navbar/Navbar.vue';
import axios from 'axios';

export default {
    data() {
        return {
            data: {
                city: '',
                checkIn: '',
                checkOut: '',
                person: '',
                room: '',
                person: '',
                room: '',
                token: localStorage.getItem('token')
            }
        }
    },
    components: {
        'app-navbar': Navbar
    },
    methods: {
        searchHotel() {
            this.$router.push('/list');
            axios.post('/api/search', this.data)
                .then(function (response) {
                    console.log(response);
                })
        }
    }
}
</script>

<style>

</style>