<template>
    <div>
        <div class="card mt-3" v-for="post in posts" style="display:none" :key="post.title">
            <img class="card-img-top" :src=" post.image" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.content }}</p>
                <button class="btn btn-primary" v-on:click="postClick">Ver resumen</button>
                <router-link class="btn btn-success" to="{name: 'detail' params: {id: post.id}">Ver</router-link>
            </div>

        </div>
        <modal-post :post="postSelected"></modal-post>

        <v-pagination
            class="mt-3"
            v-model="currentPage"
            :page-count="total"
            :classes="bootstrapPaginationClasses"
            :labels="paginationAnchorTexts"
        ></v-pagination>

    </div>
</template>

<script>
    import vPagination from 'vue-plain-pagination';
    export default {
        components: {vPagination},
        watch:{
            currentPage: function(newVal, oldVal){
                this.$emit('getCurrentPage', newVal);
            }
        },
        props:["posts", "total", "pCurrentPage"],
        created(){
            this.currentPage = this.pCurrentPage;
        },
        methods: {
            postClick: function(p){
                this.postSelected = p;
            },
        },
        data: function () {
            return {
                postSelected: "",
                currentPage: 1,
                bootstrapPaginationClasses: {
                    ul: 'pagination',
                    li: 'page-item',
                    liActive: 'active',
                    liDisable: 'disabled',
                    button: 'page-link'
                },
                paginationAnchorTexts: {
                    first: 'First',
                    prev: 'Previous',
                    next: 'Next',
                    last: 'Last'
                }
            }
        }
    };
</script>
