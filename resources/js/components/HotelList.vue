<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <h2>Your search results in Abu Dhabi, United Arab Emirates</h2>
            <section>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="control-label">Filter (By hotel name):</label>
                            <input type="search" placeholder="Type hotel name to short the list" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Sort:</label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="button" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-sort"></i>
                                        Rating
                                    </button>
                                    <button type="button" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-sort"></i>
                                        Fare
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div v-for="data in datas" :key="data.id">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <h4>
                                                <strong>
                                                    <router-link :to="{ name: 'detail', params: {id:data.hotel_id} }">Hotel {{ data.name }}</router-link>
                                                    <!-- <a href="hotel-detail.html">Hotel {{ data.name }}</a> -->
                                                </strong>
                                            </h4>
                                            <ul class="rating d-inlineblock" v-for="rate in data.rating" :key="rate">
                                                <li><i class="glyphicon glyphicon-star"></i></li>
                                            </ul>
                                            <div class="location">
                                                <small>
                                                    <i class="glyphicon glyphicon-map-marker"></i> {{ data.location }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <h3 class="price text-danger"><strong>IDR {{ formatPrice(data.price) }}</strong></h3>
                                            <div>
                                                <router-link :to="{ name: 'detail', params: {id: data.hotel_id} }">
                                                    <a class="btn btn-primary">See Room</a>
                                                </router-link>
                                                <!-- <a href="hotel-detail.html" class="btn btn-primary">See Room</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <ul class="pagination"> 
                        <li :class='{ disabled: !pagination.first_link }' ><a href="#" @click.prevent="fetchHotel(pagination.first_link)">&laquo;</a></li>
                        <li :class="{ disabled: !pagination.prev_link }" ><a href="#" @click.prevent="fetchHotel(pagination.prev_link)" >&lsaquo;</a></li>
                        <li  v-for="x in pagination.last_page" :key="x" :class="{ active: pagination.current_page == x }"><a href="#" @click.prevent="fetchHotel(pagination.path_page + x)" >{{ x }}</a></li>
                        <li :class="{ disabled: !pagination.next_link }" ><a href="#" @click.prevent="fetchHotel(pagination.next_link)" >&rsaquo;</a></li>
                        <li :class="{ disabled: !pagination.last_link }"><a href="#" @click.prevent="fetchHotel(pagination.last_link)">&raquo;</a></li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import Navbar from './Navbar/Navbar.vue'
import axios from 'axios';

export default {
    data() {
        return {
            datas: [],
            token: {
                token: localStorage.getItem('token')
            },
            pagination: {}
        }
    },
    components: {
        'app-navbar': Navbar
    },
    created() {
        this.fetchHotel();
    },
    methods: {
        fetchHotel(url) {
            let page_url =  url || '/api/searchHotel';

            axios.post(page_url, this.token)
                .then(response => {
                    this.datas = response.data.data.data;
                    console.log(response);
                    this.pagination = {
                        'current_page' : response.data.data.current_page,
                        'last_page' : response.data.data.last_page,
                        'from_page' : response.data.data.from,
                        'to_page' : response.data.data.to,
                        'total_page': response.data.data.total,
                        'path_page': response.data.data.path + '?page=',
                        'first_link' : response.data.data.first_page_url,
                        'prev_link' : response.data.data.prev_page_url,
                        'next_link' : response.data.data.next_page_url,
                        'last_link' : response.data.data.last_page_url,
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.',',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>