import Vue from 'vue';
import Router from 'vue-router';
import Map from '@/components/Map';
import Login from '@/components/Login';
import Panel from '@/components/Panel';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Panel',
      component: Panel
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/map',
      name: 'map',
      component: Map
    }
  ]
});
