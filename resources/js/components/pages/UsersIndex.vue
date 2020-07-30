<template>
    <section class="section">
        <div class="box users">
            <div class="loading" v-if="loading">
                Loading...
            </div>

            <div v-if="error" class="error">
                {{ error }}
            </div>

            <ul v-if="users">
                <li v-for="{ name, email } in users">
                    <strong>Name:</strong> {{ name }},
                    <strong>Email:</strong> {{ email }}
                </li>
            </ul>
        </div>
    </section>
</template>
<script>
    import axios from 'axios';
    import { mapState } from 'vuex';
    export default {
        data() {
            return {
                loading: false,
                error: null,
            };
        },
        computed: mapState({
            users: state => state.users
        }),
        created() {
            // this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.users = null;
                this.loading = true;
                axios
                    .get('/api/users')
                    .then(response => {
                        this.loading = false;
                        this.users = response.data;
                    });
            }
        }
    }
</script>
