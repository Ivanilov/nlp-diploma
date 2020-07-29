<template>
    <fragment>
        <navbar></navbar>
        <router-view></router-view>
    </fragment>
</template>
<script>
    import Navbar from './Navbar';
    export default {
        components: {Navbar}
    }
</script>
