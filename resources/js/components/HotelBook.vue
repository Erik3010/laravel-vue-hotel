<template>
    <div>
        <app-navbar></app-navbar>  
        <div class="container">
            <h2>Booking</h2>
            <div class="row">
                <div class="col-md-8">
                    <form role="form" @submit.prevent="booking">
                        <section>
                            <h3>Contact Information</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                First Name:
                                            </label>
                                            <input 
                                                type="text" 
                                                class="form-control"
                                                :value="data.search_data.user_name"
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Last Name:
                                            </label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's Mobile phone number
                                            </label>
                                            <input 
                                                type="tel" 
                                                class="form-control"
                                                :value="data.search_data.phone"
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's email address
                                            </label>
                                            <input 
                                                type="email" 
                                                class="form-control"
                                                :value="data.search_data.email"
                                            >
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Done</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h3>Guest Details ({{ data.search_data.guest }}) </h3>
                            <div class="panel panel-default" v-for="(tamu, i) in data.search_data.guest" :key="tamu">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Title:</label>
                                            <select 
                                                class="form-control"
                                                v-model="data.guest.title[i]"
                                            >
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">First Name:</label>
                                            <input 
                                                type="text" 
                                                class="form-control"
                                                v-model="data.guest.first_name[i]"
                                            >
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">Last Name:</label>
                                            <input 
                                                type="text" 
                                                class="form-control"
                                                v-model="data.guest.last_name[i]"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <h3>Price Details</h3>
                            <div>
                                <h5>
                                    <strong>Hotel {{ data.bookingData.hotel_name }}</strong>
                                </h5>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <strong>{{ data.bookingData.room_type }} (x{{ data.search_data.nights }} nights)</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong>IDR {{ formatPrice(data.bookingData.room_price) }}</strong>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <span>Tax</span>
                                        </div>
                                        <div class="pull-right">
                                            <span>Included</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item list-group-item-info">
                                        <div class="pull-left">
                                            <strong>You Pay</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong>IDR {{ formatPrice(data.bookingData.room_price) }}</strong>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>
                            </div>
                        </section>
                        <section>
                            <h3>Payment</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Payment Method:
                                        </label>
                                        <select 
                                            class="form-control" 
                                            @change="paymentHandler"
                                            v-model="data.payment.payment_method"
                                            
                                            >
                                            <option value="transfer">Transfer</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">Paypal</option>
                                        </select>
                                    </div>
                                    <h4>Credit Card</h4>
                                    <div class="form-group">
                                        <label class="control-label">Card Number</label>
                                        <input 
                                            type="number" 
                                            class="form-control" 
                                            placeholder="16 digit card number"
                                            :disabled="disabled"
                                            v-model="data.payment.card_number"
                                            >
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <label class="control-label">Name on card:</label>
                                            <input 
                                                type="text" 
                                                class="form-control"
                                                :disabled="disabled"
                                                v-model="data.payment.name_on_card"
                                                >
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="control-label">CCV Code:</label>
                                            <input 
                                                type="number" 
                                                maxlength="3" 
                                                class="form-control" 
                                                placeholder="3 digit CCV"
                                                :disabled="disabled"
                                                v-model="data.payment.ccv_code"
                                                >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="text-right">
                                <button 
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                    Continue to Booking
                                </button>
                            </div>
                        </section>
                    </form>
                </div>
                <div class="col-md-4">
                    <h3>Booking Details</h3>
                    <aside>
                        <article>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4><strong>Hotel {{ data.bookingData.hotel_name }}</strong></h4>
                                            <ul class="rating d-inlineblock" v-for="rate in data.bookingData.rating" :key="rate">
                                                <li><i class="glyphicon glyphicon-star"></i></li>
                                            </ul>
                                            <div class="location">
                                                <small>
                                                    <i class="glyphicon glyphicon-map-marker"></i> {{ data.bookingData.location }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <ul class="list-group" style="margin-bottom: 0;">
                                                <li class="list-group-item">
                                                    <div class="pull-left">Duration of Stay</div>
                                                    <div class="pull-right">{{ data.search_data.nights }} Nights</div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">Check-in</div>
                                                    <div class="pull-right">{{ data.search_data.search_checkIn }}</div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">Check-out</div>
                                                    <div class="pull-right">{{ data.search_data.search_checkOut }}</div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">Room type</div>
                                                    <div class="pull-right">{{ data.bookingData.room_type }}</div>
                                                    <div class="clearfix"></div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="pull-left">No. of rooms</div>
                                                    <div class="pull-right">{{ data.search_data.room }} Room(s)</div>
                                                    <div class="clearfix"></div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from './Navbar/Navbar.vue'
import axios from 'axios'

export default {
    data() {
        return {
            data: {
                bookingData: {},
                search_data: {},
                guest: {
                    title: [],
                    first_name: [],
                    last_name: []
                },
                payment: {
                    payment_method: '',
                    card_number: '',
                    name_on_card: '',
                    ccv_code: ''
                },
                token: localStorage.getItem('token')
            },
            disabled: true
        }
    },
    components: {
        'app-navbar': Navbar
    },
    created() {
        let hotelId = this.$route.params.hotelId;
        let roomId = this.$route.params.roomId;
        let token = localStorage.getItem('token');

        axios.get('/api/hotel/'+hotelId+'/room/'+roomId)
            .then(response => {
                this.data.bookingData = response.data.data
                // console.log(this.data);
            })

        axios.get('/api/getSearch/'+token)
            .then(response => {
                this.data.search_data = response.data.data
                // console.log(this.search_data)
            })

        // let totalRoomPrice = parseInt(this.data.room_price) * parseInt(this.search_data.nights);
    },
    methods: {
        paymentHandler(e) {
            let value = e.target.value
            this.disabled = false

            if(value!="credit_card"){
                this.disabled = true;
                
                this.data.payment.card_number = ''
                this.data.payment.name_on_card = ''
                this.data.payment.ccv_code = ''
            }
        },
        
        formatPrice(value) {
            let val = parseInt(value) * parseInt(this.data.search_data.nights);
            // return parseInt(value)
            val = (val/1).toFixed(2).replace('.',',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        booking() {
            axios.post('/api/booking', this.data)
                .then(response => {
                    console.log(response)
                })
        }
    }
}
</script>