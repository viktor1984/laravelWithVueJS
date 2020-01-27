<template>
    <div id="app">
        <router-link tag="li" to="/" exact>
            <a>Home</a>
        </router-link>
        <router-link tag="li" to="/projects">
            <a>Projects</a>
        </router-link>

        <router-view></router-view>
    </div>
</template>

<script>


    export default {
        name: 'Application',
        data () {
            return {

            }
        }
    }
</script>

