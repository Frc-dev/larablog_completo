<template>
    <div class="row">
        <div class="col-md-3" v-for="category in categories" style="display:none" :key="category.id">
        <div class="card mt-3">
            <router-link to="{name: 'post-category' params: {category_id: category.id}"> </router-link>
            <img :src='"/images_category/php.svg"' class="card-img-top mt-3" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:["posts", "total", "pCurrentPage"],
        created(){
            this.getCategories();
        },
        methods: {
            getCategories: function(){
                fetch("/api/post/")
                    .then(response => response.json())
                    .then(json => (this.posts = json.data))

            },
        },
        data: function () {
            return {

            }
        }
    };
</script>
