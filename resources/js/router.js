import Vue from 'vue';
import VueRouter from 'vue-router';
import store from './store.js';

// component
import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';
import Register from './components/auth/Register.vue';
import HotelList from './components/HotelList.vue';
import HotelDetail from './components/HotelDetail.vue';
import HotelBook from './components/HotelBook.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/list',
        component: HotelList
    },
    {
        path: '/detail/:id',
        component: HotelDetail,
        name: 'detail'
    },
    {
        path: '/book/:hotelId/:roomId',
        component: HotelBook,
        name: 'book'
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

// check the route need authentication or no
router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        // let auth = store.getters.isAuth;
        // check if user is authenticated from store -> state -> localstorage -> token
        // if(!auth){
        //     // user not authenticated
        //     next({ path: '/login' })
        // }else{
        //     // user authenticated
        //     next();
        // }
        if(!localStorage.getItem('token')) {
            next({ path: '/Login' })
        } else {
            next();
        }
    // allow user to go
    }else{
        next();
    }
});

export default router