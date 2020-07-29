<template>
    <section class="section">
        <navbar></navbar>
        <div class="container is-fluid">
            <router-view></router-view>
        </div>
    </section>
</template>
<script>
    import Navbar from './Navbar';
    export default {
        components: {Navbar}
    }
</script>
