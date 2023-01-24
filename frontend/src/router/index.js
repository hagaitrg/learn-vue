import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'blog.index',
        component: ()=> import(/* webpackChunkName: "blog.index" */ '@/views/blog/Index.vue')
    },
    {
        path: '/create',
        name: 'blog.create',
        component: ()=> import(/* webpackChunkName: "blog.create" */ '@/views/blog/Create.vue')
    },
    {
        path: '/edit/:id',
        name: 'blog.edit',
        component: ()=> import(/* webpackChunkName: "blog.edit" */ '@/views/blog/Edit.vue')
    },
];

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router