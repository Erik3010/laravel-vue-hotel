<template>
    <div>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="flight.html">Flights</a></li>
                        <li><a href="hotel.html">Hotels</a></li>
                        <router-link to="/login" tag="li" v-if="!token">
                            <a>Log In</a>
                        </router-link>
                        <router-link to="/register" tag="li" v-if="!token">
                            <a>Register</a>
                        </router-link>
                        <router-link to="/login" tag="li" v-if="token">
                            <a @click="logout">Logout</a>
                        </router-link>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            token: localStorage.getItem('token')
        }
    },
    methods: {
        logout() {
            localStorage.removeItem('token');
        }
    }
}
</script>