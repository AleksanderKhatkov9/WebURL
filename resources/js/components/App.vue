<template>
    <div class="container">
        <form @submit.prevent="submitUrl" class="mt-3">
            <div class="input-group mb-3">
                <input v-model="url" type="text" class="form-control" placeholder="Enter URL">
                <button type="submit" class="btn btn-primary">Shorten URL</button>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Original URL</th>
                <th scope="col">Shortened URL</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="link in links" :key="link.id">
                <td>{{ link.id }}</td>
                <td>{{ link.original_url }}</td>
                <td><a :href="'/' + link.id ">{{ link.short_url }}</a></td>
            </tr>
            </tbody>
        </table>

        <div v-if="error" class="alert alert-danger" role="alert">
            {{ error }}
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            url: '',
            links: null,
            error: ''
        };
    },

    mounted() {
        this.getDataLink()
    },

    methods: {
        submitUrl() {
            axios.post('/shorten', {url: this.url})
                .then(response => {
                    console.log(response.data.shortened_url);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        getDataLink() {
            axios.get(`api/link`)
                .then(response => {
                    this.links = response.data;
                })
                .catch((err) => {
                    this.error = "Failed to retrieve data: " + err;
                    console.log(err)
                })
        }
    }
};
</script>

<style scoped>
.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>
