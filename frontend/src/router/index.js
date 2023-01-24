import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/',
        name: 'blog.index',
        component: ()=> import(/* webpackChunkName: "blog.index" */ '@/views/blog/IndexBlog.vue')
    },
    {
        path: '/create',
        name: 'blog.create',
        component: ()=> import(/* webpackChunkName: "blog.create" */ '@/views/blog/CreateBlog.vue')
    },
    {
        path: '/edit/:id',
        name: 'blog.edit',
        component: ()=> import(/* webpackChunkName: "blog.edit" */ '@/views/blog/EditBlog.vue')
    },
];

const router = createRouter({
    history:createWebHistory(),
    routes
})

export default router