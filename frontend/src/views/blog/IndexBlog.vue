<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rouunded shadow">
                    <div class="card-body">
                        <h4>Data Blogs</h4>
                        <hr>
                        <router-link :to="{name: 'blog.create'}" class="btn btn-md btn-success">+ Add Blog</router-link>

                        <table class="table table-striped table-bordered mt-4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Published</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(blog,index) in blogs" :key="index">
                                    <td>{{ index+1 }}</td>
                                    <td>{{ blog.title }}</td>
                                    <td>{{ blog.content }}</td>
                                    <td >
                                        <span v-if="(blog.published == 1)" class="badge text-bg-success">True</span>
                                        <span v-else class="badge text-bg-danger">False</span>
                                    </td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'blog.edit', params:{id: blog.id }}" class="btn btn-sm btn-warning">Edit</router-link> |
                                        <button class="btn btn-sm btn-info">Published</button> |
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue';
    
export default{
    setup() {
        let blogs = ref([])

        onMounted(()=>{
            axios.get("http://localhost:8000/api/v1/blogs/")
            .then(res=>{
                blogs.value = res.data.data
            }).catch(err => {
                console.log(err.response.message);
            })
        })

        return {
            blogs
        }
    }
}
</script>

<style>
    body{
        background: lightgray;
    }
</style>