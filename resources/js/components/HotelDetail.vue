<template>
    <div>
        <app-navbar></app-navbar>
        <div class="container">
            <section>
                <h2>{{ hotelDetail.location }}</h2>
                <article>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <h4><strong>Hotel {{ hotelDetail.name }}</strong></h4>
                                            <ul class="rating d-inlineblock" v-for="rate in hotelDetail.rating" :key="rate">
                                                <li><i class="glyphicon glyphicon-star"></i></li>
                                            </ul>
                                            <div class="location">
                                                <small>
                                                    <i class="glyphicon glyphicon-map-marker"></i> {{ hotelDetail.location }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <div><strong>Starting from:</strong></div>
                                            <h3 class="price text-danger"><strong>IDR {{ formatPrice(hotelDetail.price) }}</strong></h3>
                                            <div>
                                                <!-- <a href="hotel-book.html" class="btn btn-primary">Book Now</a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
            <section>
                <h3>Rooms Available</h3>
                <ul class="list-group" v-for="data in datas" :key="data.id">
                    <li class="list-group-item hotel-list">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Room Name:</label>
                                <h4>{{ data.type }}</h4>
                            </div>
                            <div class="col-sm-4 text-right">
                                <label class="control-label">Room Price:</label>
                                <h4 class="price text-danger"><strong>IDR {{ formatPrice(data.price) }}</strong></h4>
                            </div>
                            <div class="col-sm-2 text-center">
                                <router-link :to="{ name: 'book', params: {hotelId:data.hotel_id, roomId: data.id} }">
                                    <a class="btn btn-primary">Book Now</a>
                                </router-link>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</template>

<script>
import Navbar from './Navbar/Navbar'
import axios from 'axios'

export default {
    data() {
        return {
            datas: [],
            hotelDetail: {}
        }
    },
    components: {
        'app-navbar': Navbar
    },
    created() {
        let id = this.$route.params.id;
        // console.log(id);
        axios.get('/api/hotel/'+id)
            .then(response => {
                this.datas = response.data.data
                this.hotelDetail = response.data.hotel_detail
                // console.log(response.data)
            })
    },
    methods: {
        formatPrice(value) {
            let val = (value/1).toFixed(2).replace('.',',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }
}
</script>