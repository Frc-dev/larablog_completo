<template>
    <div>
        <h1>{{ category.title }}</h1>
        <post-list-default
            :key="currentPage"
            @getCurrentPage="getCurrentPage"
            v-if="total>0"
            :pCurrentPage="currentPage"
            :posts="posts"
            :total="total">

        </post-list-default>
    </div>
</template>

<script>
    export default {
        created(){
            this.getPost();
        },
        methods: {
            postClick: function(p){
                this.postSelected = p.title;
            },
            getPosts(){
                fetch('/api/post/'+ this.$route.params.category_id + "/category?page="+ this.currentPage)
                    .then(response => response.json())
                    .then(json => {
                        this.posts = json.data.posts.data;
                        this.total = json.data.posts.last_page;
                        this.category = json.data.category;
                    });

                /*fetch('/api/post')
                    .then(function(response){
                        return response.json();
                    })
                    .then(function(json){
                        this.posts = json.data.data;
                    })*/
            },
            getCurrentPage: function(val){
                this.currentPage = val;
                this.getPosts()
            }
        },
        data: function () {
            return {
                postSelected: "",
                posts: [],
                category: "",
                total: 0,
                currentPage: 1,
            }
        }
    };
</script>
