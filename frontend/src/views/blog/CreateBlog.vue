<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>Create New Blog</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label for="title" class="font-weight-bold">Title</label>
                                <input type="text" class="form-control" v-model="blog.title" placeholder="Blog Title">
                                <!-- validation -->
                                <div v-if="validation.title" class="mt-2 alert alert-danger">
                                    {{ validation.title[0] }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="font-weight-bold">Content</label>
                                <textarea class="form-control" rows="4" v-model="blog.content" placeholder="Blog Content"></textarea>
                                <!-- validation -->
                                <div v-if="validation.content" class="mt-2 alert alert-danger">
                                    {{ validation.content[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref} from 'vue'
import { useRouter } from 'vue-router';
import axios from 'axios'

export default{
    setup(){
        const blog = reactive({
            title: '',
            content: ''
        })

        const validation = ref([])
        const router = useRouter()

        function store(){
            let title = blog.title
            let content = blog.content

            axios.post('http://localhost:8000/api/v1/blogs/', {
                title:title,
                content:content
            }).then(()=>{
                router.push({
                    name: 'blog.index'
                })
            }).catch(err=>{
                validation.value = err.response.message
            })
        }

        return {
            blog,
            validation,
            router,
            store
        }
    }
}
</script>

<style>
    body{
        background: lightgray;
    }
</style>